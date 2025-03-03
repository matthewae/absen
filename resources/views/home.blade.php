@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <!-- Total Employees -->
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Employees</h5>
                    <h2 class="mb-0">{{ $totalEmployees }}</h2>
                </div>
            </div>
        </div>
        <!-- Present Today -->
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Present Today</h5>
                    <h2 class="mb-0">{{ $presentToday }}</h2>
                </div>
            </div>
        </div>
        <!-- Late Today -->
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Late Today</h5>
                    <h2 class="mb-0">{{ $lateToday }}</h2>
                </div>
            </div>
        </div>
        <!-- Leave Today -->
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">On Leave Today</h5>
                    <h2 class="mb-0">{{ $leaveToday }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentAttendance as $attendance)
                                <tr>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->date->format('M d, Y') }}</td>
                                    <td>{{ $attendance->time_in ? $attendance->time_in->format('H:i A') : '-' }}</td>
                                    <td>{{ $attendance->time_out ? $attendance->time_out->format('H:i A') : '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $attendance->status == 'present' ? 'success' : ($attendance->status == 'late' ? 'warning' : 'info') }}">
                                            {{ ucfirst($attendance->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
