<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkProgress;
use App\Models\Attendance;
use Illuminate\Http\Request;

class SupervisorDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $employeeIds = $user->employees->pluck('staff_id');

        $workProgress = WorkProgress::whereIn('user_id', $employeeIds)
            ->with('user')
            ->latest()
            ->get();

        $attendances = Attendance::whereIn('user_id', $employeeIds)
            ->with('user')
            ->latest()
            ->get();

        return view('super', compact('workProgress', 'attendances'));
    }

    public function updateWorkProgressStatus(Request $request, WorkProgress $workProgress)
    {
        $request->validate([
            'status' => 'required|in:pending,revision,approved'
        ]);

        $user = auth()->user();
        
        if ($user->role !== 'supervisor' || !$user->employees->contains($workProgress->user_id)) {
            return back()->with('error', 'Unauthorized action');
        }

        $workProgress->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Work progress status updated successfully');
    }
}