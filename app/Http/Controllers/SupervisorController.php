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
        $workProgress = \App\Models\WorkProgress::with(['user', 'attachments'])->latest()->get();
        $attendances = \App\Models\Attendance::with('user')->latest()->get();
        
        return view('super', compact('workProgress', 'attendances'));
    }

    public function showLoginForm()
    {
        return view('auth.LGSuper');
    }
}