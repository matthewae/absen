<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
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

        return view('home', compact(
            'totalEmployees',
            'presentToday',
            'lateToday',
            'leaveToday',
            'recentAttendance'
        ));
    }
}
