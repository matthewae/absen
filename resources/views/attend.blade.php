<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Attendance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #FFD700;
            --text-color: #2c3e50;
            --bg-light: #f8f9fa;
            --transition: all 0.3s ease;
        }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
            background-color: var(--bg-light);
            color: var(--text-color);
            margin: 0;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background-color: var(--primary-color);
            color: white;
            padding-top: 20px;
            transition: var(--transition);
            z-index: 1000;
        }

        .sidebar h4 {
            color: var(--accent-color);
            font-weight: 700;
            padding: 0 20px;
            margin-bottom: 30px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: var(--transition);
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--secondary-color);
            color: var(--accent-color);
            transform: translateX(5px);
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            background-color: var(--bg-light);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
            background-color: var(--primary-color) !important;
            color: white;
            padding: 1.5rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
        }

        .btn-record {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: var(--transition);
        }

        .btn-record:hover {
            background-color: var(--secondary-color);
            color: var(--accent-color);
            transform: translateY(-2px);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .status-in {
            background-color: #28a745;
            color: white;
        }

        .status-out {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="col-md-2 sidebar">
        <h4>PT. Mandajaya</h4>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('primary') ? 'active' : '' }}" href="{{ route('primary') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('attend') ? 'active' : '' }}" href="{{ route('attend') }}">
                <i class="fas fa-clock"></i> Attendance
            </a>
            <a class="nav-link {{ request()->routeIs('jdwl') ? 'active' : '' }}" href="{{ route('jdwl') }}">
                <i class="fas fa-calendar"></i> Schedule
            </a>
            <a href="{{ route('work-progress.index') }}" class="nav-link {{ request()->routeIs('work-progress.index') ? 'active' : '' }}">
                <i class="fas fa-tasks"></i> Work Progress
            </a>
            <a class="nav-link {{ request()->routeIs('pro') ? 'active' : '' }}" href="{{ route('pro') }}">
                <i class="fas fa-user"></i> Profile
            </a>
            <a class="nav-link {{ request()->routeIs('set') ? 'active' : '' }}" href="{{ route('set') }}">
                <i class="fas fa-cog"></i> Settings
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="nav-link text-danger border-0 bg-transparent">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    <div class="main-content">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ __('Attendance Records') }}</h4>
                <div>
                    <button class="btn btn-record me-2" data-bs-toggle="modal" data-bs-target="#leaveRequestModal">
                        <i class="fas fa-file-medical me-2"></i>Submit Leave Request
                    </button>
                    <button class="btn btn-record" data-bs-toggle="modal" data-bs-target="#recordAttendanceModal">
                        <i class="fas fa-plus-circle me-2"></i>Record Attendance
                    </button>
                </div>
            </div>

            <div class="card-body p-4">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="py-3">Date</th>
                                <th class="py-3">Check In</th>
                                <th class="py-3">Check Out</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Notes</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attend as $attendance)
                            <tr>
                                <td class="py-3">{{ $attendance->date->format('Y-m-d') }}</td>
                                <td class="py-3">{{ $attendance->time_in ? $attendance->time_in->format('H:i:s') : '-' }}</td>
                                <td class="py-3">{{ $attendance->time_out ? $attendance->time_out->format('H:i:s') : '-' }}</td>
                                <td class="py-3">
                                    @if($attendance->time_in && !$attendance->time_out)
                                    <span class="status-badge status-in">Checked In</span>
                                    @elseif($attendance->time_in && $attendance->time_out)
                                    <span class="status-badge status-out">Checked Out</span>
                                    @else
                                    <span class="status-badge status-absent">Not Checked In</span>
                                    @endif
                                </td>
                                <td class="py-3">{{ $attendance->notes ?? '-' }}</td>
                                <td class="py-3 text-center">
                                    @if($attendance->time_in && !$attendance->time_out && $attendance->date->isToday())
                                    <form action="{{ route('attendance.checkout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fas fa-sign-out-alt me-1"></i>Check Out
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Record Attendance Modal -->
    <div class="modal fade" id="recordAttendanceModal" tabindex="-1" aria-labelledby="recordAttendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recordAttendanceModalLabel">Record Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Add any notes about your attendance..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-record">Record Attendance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Leave Request Modal -->
    <div class="modal fade" id="leaveRequestModal" tabindex="-1" aria-labelledby="leaveRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leaveRequestModalLabel">Submit Leave Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('attendance.leave') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="leave_date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="leave_date" name="leave_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="leave_reason" class="form-label">Reason</label>
                            <select class="form-select" id="leave_reason" name="leave_reason" required>
                                <option value="">Select reason</option>
                                <option value="sick">Sick Leave</option>
                                <option value="personal">Personal Leave</option>
                                <option value="family">Family Emergency</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="leave_notes" class="form-label">Additional Notes</label>
                            <textarea class="form-control" id="leave_notes" name="leave_notes" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="leave_document" class="form-label">Supporting Document (optional)</label>
                            <input type="file" class="form-control" id="leave_document" name="leave_document">
                            <div class="form-text">Upload any supporting documents (e.g., medical certificate)</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-record">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>