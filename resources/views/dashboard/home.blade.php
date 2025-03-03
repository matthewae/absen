@extends('layouts.dashboard')

@section('dashboard-content')
<div class="container-fluid">
    <h1 class="mb-4">Dashboard</h1>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="card-title text-primary">Today's Attendance</h5>
                    <div class="d-flex align-items-center mt-3">
                        <i class="fas fa-user-clock fa-2x text-primary"></i>
                        <div class="ms-3">
                            <h3 class="mb-0">{{ $todayAttendance ?? 'Not Checked In' }}</h3>
                            <small class="text-muted">{{ now()->format('l, d M Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="card-title text-success">Work Progress</h5>
                    <div class="d-flex align-items-center mt-3">
                        <i class="fas fa-tasks fa-2x text-success"></i>
                        <div class="ms-3">
                            <h3 class="mb-0">{{ $workProgressCount ?? 0 }}</h3>
                            <small class="text-muted">Total Submissions</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <h5 class="card-title text-info">Attendance Rate</h5>
                    <div class="d-flex align-items-center mt-3">
                        <i class="fas fa-chart-line fa-2x text-info"></i>
                        <div class="ms-3">
                            <h3 class="mb-0">{{ $attendanceRate ?? '0%' }}</h3>
                            <small class="text-muted">This Month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent Activities</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Activity</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentActivities ?? [] as $activity)
                                <tr>
                                    <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>
                                        <span class="badge bg-{{ $activity->status_color }}">{{ $activity->status }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No recent activities</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stat-card {
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.card-title {
    font-weight: 600;
}

.table {
    margin-bottom: 0;
}

.badge {
    padding: 0.5em 1em;
}
</style>
@endsection