<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

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
                return redirect()->back()->with('error', 'You have already completed your attendance for today.');
            }

            $existingAttendance->update([
                'time_out' => now(),
                'notes' => $request->notes
            ]);

            return redirect()->back()->with('status', 'Check-out recorded successfully.');
        }

        Attendance::create([
            'user_id' => $user->id,
            'date' => $today,
            'time_in' => now(),
            'notes' => $request->notes
        ]);

        return redirect()->back()->with('status', 'Check-in recorded successfully.');
    }
}