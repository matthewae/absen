<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $employeeIds = $user->employees()->pluck('staff_id');
        
        $workProgress = \App\Models\WorkProgress::with(['user', 'attachments'])
            ->whereIn('user_id', $employeeIds)
            ->latest()
            ->get();
            
        $attendances = \App\Models\Attendance::with('user')
            ->whereIn('user_id', $employeeIds)
            ->latest()
            ->get();
        
        return view('super', compact('workProgress', 'attendances'));
    }

    public function showLoginForm()
    {
        return view('auth.LGSuper');
    }
}