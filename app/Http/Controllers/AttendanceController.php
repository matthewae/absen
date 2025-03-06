<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function index()
    {
        $attend = Attendance::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->get();

        return view('attend', compact('attend'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $today = Carbon::today();

        $existingAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        if ($existingAttendance) {
            if ($existingAttendance->time_out) {
                return redirect()->back()->with('error', 'You have already completed your attendance for today. You cannot record attendance twice.');
            }

            // Check if user has submitted work progress for today
            $hasWorkProgress = \App\Models\WorkProgress::where('user_id', $user->id)
                ->whereDate('created_at', $today)
                ->exists();

            if (!$hasWorkProgress) {
                return redirect()->back()->with('error', 'Please submit your work progress before checking out.');
            }

            $existingAttendance->update([
                'time_out' => now(),
                'notes' => $request->notes
            ]);

            return redirect()->back()->with('status', 'Check-out recorded successfully. Have a great day!');
        }

        Attendance::create([
            'user_id' => $user->id,
            'date' => $today,
            'time_in' => now(),
            'notes' => $request->notes,
            'status' => 'present'
        ]);

        return redirect()->back()->with('status', 'Check-in recorded successfully. Welcome to work!');
    }

    public function leave(Request $request)
    {
        $request->validate([
            'leave_date' => 'required|date',
            'leave_reason' => 'required|string',
            'leave_notes' => 'nullable|string',
            'leave_document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

        $user = auth()->user();
        $leaveDate = Carbon::parse($request->leave_date);

        // Check if attendance already exists for the date
        $existingAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', $leaveDate)
            ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('error', 'Attendance record already exists for this date.');
        }

        // Handle document upload
        $documentPath = null;
        if ($request->hasFile('leave_document')) {
            $documentPath = $request->file('leave_document')->store('leave-documents', 'public');
        }

        // Create attendance record with leave information
        Attendance::create([
            'user_id' => $user->id,
            'date' => $leaveDate,
            'notes' => "Leave Request - Reason: {$request->leave_reason}\nNotes: {$request->leave_notes}" .
                ($documentPath ? "\nDocument: {$documentPath}" : ""),
            'is_leave' => true
        ]);

        return redirect()->back()->with('status', 'Leave request submitted successfully.');
    }
}