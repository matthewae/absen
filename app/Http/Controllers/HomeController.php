<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Schedule;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $today = Carbon::today();
        
        // Get attendance statistics
        $totalEmployees = User::count();
        $presentToday = Attendance::where('date', $today)
            ->whereIn('status', ['present'])
            ->count();
        $lateToday = Attendance::where('date', $today)
            ->where('status', 'late')
            ->count();
        $leaveToday = Attendance::where('date', $today)
            ->where('status', 'leave')
            ->count();

        // Get recent attendance records
        $recentAttendance = Attendance::with('user')
            ->orderBy('date', 'desc')
            ->orderBy('time_in', 'desc')
            ->take(10)
            ->get();

        // Get staff schedules for the current user
        $staffSchedules = [];
        if (auth()->check()) {
            $staffSchedules = Schedule::where('staff_id', auth()->id())
                ->orderBy('start_time')
                ->get()
                ->map(function ($schedule) {
                    return [
                        'title' => $schedule->title,
                        'start' => $schedule->start_time->format('Y-m-d\\TH:i:s'),
                        'end' => $schedule->end_time->format('Y-m-d\\TH:i:s'),
                        'type' => $schedule->type
                    ];
                });
        }

        return view('primary', compact(
            'totalEmployees',
            'presentToday',
            'lateToday',
            'leaveToday',
            'recentAttendance',
            'staffSchedules'
        ));
    }
}
