<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $staffMembers = User::where('role', 'staff')->get();
        return view('SPVSchedule', compact('staffMembers'));
    }

    public function getSchedules()
    {
        $user = Auth::user();
        $query = Schedule::with('staff');

        if ($user->role === 'staff') {
            $query->where('staff_id', $user->id);
        }

        $schedules = $query->get();

        return response()->json($schedules->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'title' => $schedule->title,
                'start' => $schedule->start_time,
                'end' => $schedule->end_time,
                'description' => $schedule->description,
                'type' => $schedule->type,
                'staff' => $schedule->staff ? $schedule->staff->name : null,
                'backgroundColor' => $this->getEventColor($schedule->type)
            ];
        }));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time'
        ]);

        $schedule = Schedule::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Schedule created successfully',
            'data' => $schedule
        ]);
    }

    private function getEventColor($type)
    {
        return match($type) {
            'work' => '#198754',    // Success green
            'meeting' => '#0d6efd', // Primary blue
            'training' => '#ffc107', // Warning yellow
            default => '#6c757d'    // Secondary gray
        };
    }
}