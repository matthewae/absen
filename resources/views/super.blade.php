<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Supervisor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #FFD700;
            --success-color: #198754;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #0dcaf0;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background-color: var(--primary-color);
            color: white;
            padding-top: 20px;
            transition: all 0.3s ease;
        }

        .sidebar h4 {
            color: var(--accent-color);
            font-weight: 700;
            padding: 0 20px;
            margin-bottom: 30px;
        }

        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: var(--secondary-color);
            color: var(--accent-color);
            transform: translateX(5px);
        }

        .main-content {
            flex: 1;
            padding: 2rem;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .stats-card {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .status-badge {
            padding: 0.5em 1em;
            border-radius: 20px;
            font-weight: 600;
        }

        .modal-content {
            border-radius: 15px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 250px;">
            <h4><i class="fas fa-shield-alt me-2"></i>Supervisor</h4>
            <div class="nav flex-column">
                <a href="{{ route('primary') }}" class="nav-link {{ request()->routeIs('primary') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="{{ route('supervisor.schedule') }}" class="nav-link {{ request()->routeIs('supervisor.schedule') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt me-2"></i>Schedule
                </a>
                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="fas fa-user-cog me-2"></i>Settings
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">Supervisor Dashboard</h2>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print Report
                    </button>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card stats-card mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-white">Total Employees</h5>
                            <div class="d-flex align-items-center mt-3">
                                <i class="fas fa-users fa-3x"></i>
                                <div class="ms-3">
                                    <h3 class="mb-0">{{ $employeeCount ?? 0 }}</h3>
                                    <small>Active Staff Members</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Sections -->
            <div class="row">
                <!-- Work Progress Section -->
                <div class="col-12 col-xl-7 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-tasks me-2"></i>Employee Work Progress</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Staff ID</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($workProgress as $progress)
                                        <tr>
                                            <td>{{ $progress->user->staff_id }}</td>
                                            <td>{{ $progress->user->name }}</td>
                                            <td>{{ $progress->category }}</td>
                                            <td>{{ $progress->title }}</td>
                                            <td>
                                                <span class="badge bg-{{ $progress->status === 'approved' ? 'success' : ($progress->status === 'revision' ? 'warning' : 'info') }}">
                                                    {{ ucfirst($progress->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#progressModal{{ $progress->id }}">
                                                    <i class="fas fa-eye me-1"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No work progress records found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Section -->
                <div class="col-12 col-xl-5 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0"><i class="fas fa-clock me-2"></i>Employee Attendance</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Staff ID</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($attendances as $attendance)
                                        <tr>
                                            <td>{{ $attendance->user->staff_id }}</td>
                                            <td>{{ $attendance->user->name }}</td>
                                            <td>{{ $attendance->created_at->format('d M Y') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : ($attendance->status === 'late' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($attendance->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No attendance records found</td>
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
    </div>

    <!-- Work Progress Modals -->
    @foreach($workProgress as $progress)
    <div class="modal fade" id="progressModal{{ $progress->id }}" tabindex="-1" aria-labelledby="progressModalLabel{{ $progress->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="progressModalLabel{{ $progress->id }}">Work Progress Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card h-100 bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">Employee Information</h6>
                                    <div class="mt-3">
                                        <p class="mb-2"><strong>Name:</strong> {{ $progress->user->name }}</p>
                                        <p class="mb-2"><strong>Staff ID:</strong> {{ $progress->user->staff_id }}</p>
                                        <p class="mb-2"><strong>Department:</strong> {{ $progress->user->department }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">Work Details</h6>
                                    <div class="mt-3">
                                        <p class="mb-2"><strong>Category:</strong> {{ $progress->category }}</p>
                                        <p class="mb-2"><strong>Title:</strong> {{ $progress->title }}</p>
                                        <p class="mb-2"><strong>Description:</strong> {{ $progress->description }}</p>
                                        @if($progress->attachments->count() > 0)
                                        <div class="mt-3">
                                            <h6 class="text-primary">Attachments</h6>
                                            <ul class="list-unstyled">
                                                @foreach($progress->attachments as $attachment)
                                                <li>
                                                    <a href="{{ Storage::url($attachment->file_path) }}" target="_blank" class="text-decoration-none">
                                                        <i class="fas fa-paperclip me-2"></i>{{ $attachment->original_name }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <h6 class="card-title text-primary">Status Update</h6>
                            <form action="{{ route('supervisor.work-progress.status', $progress) }}" method="POST" class="mt-3">
                                @csrf
                                @method('PATCH')
                                <div class="row align-items-end">
                                    <div class="col-md-8">
                                        <select name="status" class="form-select" required>
                                            <option value="pending" {{ $progress->status === 'pending' ? 'selected' : '' }}>Pending Review</option>
                                            <option value="revision" {{ $progress->status === 'revision' ? 'selected' : '' }}>Needs Revision</option>
                                            <option value="approved" {{ $progress->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>