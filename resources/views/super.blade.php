<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .container-fluid {
            max-width: 1600px;
        }
        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            border-radius: 10px 10px 0 0 !important;
            border-bottom: none;
        }
        .table th {
            font-weight: 600;
            white-space: nowrap;
            color: var(--primary-color);
        }
        .badge {
            font-weight: 500;
            padding: 0.5em 1em;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        @media print {
            .btn, .modal, .sidebar {
                display: none !important;
            }
            .card {
                box-shadow: none !important;
            }
            .container-fluid {
                width: 100% !important;
                max-width: none !important;
            }
        }
        .sidebar .nav-link {
            color: #FFD700;
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: var(--transition);
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: var(--secondary-color);
            color: var(--accent-color);
            transform: translateX(5px);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 250px;">
            <h4><i class="fas fa-shield-alt me-2"></i>Supervisor</h4>
            <div class="nav flex-column">
                <a href="{{ route('primary') }}" class="nav-link text-white active">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="{{ route('spvschedule') }}" class="nav-link text-white">
                    <i class="fas fa-calendar-alt me-2"></i>Schedule
                </a>
                <a href="set" class="nav-link text-white">
                    <i class="fas fa-cog me-2"></i>Settings
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="container-fluid px-4 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Supervisor Dashboard</h2>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary" onclick="window.print()">
                            <i class="fas fa-print me-2"></i>Print Report
                        </button>
                    </div>
                </div>

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
                                            @foreach($workProgress as $progress)
                                            <tr>
                                                <td><span class="badge bg-secondary">{{ $progress->user->staff_id }}</span></td>
                                                <td>{{ $progress->user->name }}</td>
                                                <td>{{ $progress->category }}</td>
                                                <td>{{ $progress->title }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $progress->status === 'approved' ? 'success' : ($progress->status === 'revision' ? 'warning' : 'info') }} rounded-pill px-3">
                                                        {{ ucfirst($progress->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#progressModal{{ $progress->id }}">
                                                        <i class="fas fa-eye me-1"></i> View
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
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
                                                <th>Time In/Out</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($attendances as $attendance)
                                            <tr>
                                                <td><span class="badge bg-secondary">{{ $attendance->user->staff_id }}</span></td>
                                                <td>{{ $attendance->user->name }}</td>
                                                <td>{{ $attendance->date->format('d M Y') }}</td>
                                                <td>
                                                    <small class="text-success d-block">In: {{ $attendance->time_in ? $attendance->time_in->format('H:i') : '-' }}</small>
                                                    <small class="text-danger d-block">Out: {{ $attendance->time_out ? $attendance->time_out->format('H:i') : '-' }}</small>
                                                </td>
                                                <td>
                                                    @if($attendance->status === 'leave_pending')
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-warning rounded-pill px-3">Leave Pending</span>
                                                        <div class="btn-group">
                                                            <form action="{{ route('supervisor.attendance.approve', $attendance->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-sm btn-success" title="Approve Leave">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('supervisor.attendance.reject', $attendance->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-sm btn-danger" title="Reject Leave">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        @if($attendance->leave_proof)
                                                        <a href="{{ asset('storage/' . $attendance->leave_proof) }}" target="_blank" class="btn btn-sm btn-info" title="View Leave Document">
                                                            <i class="fas fa-file-medical"></i>
                                                        </a>
                                                        @endif
                                                    </div>
                                                    @else
                                                    <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : ($attendance->status === 'leave_approved' ? 'info' : 'danger') }} rounded-pill px-3">
                                                        {{ ucfirst(str_replace('_', ' ', $attendance->status)) }}
                                                    </span>
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
                                                    <p class="mb-2"><i class="fas fa-id-card me-2 text-primary"></i><strong>Staff ID:</strong> {{ $progress->user->staff_id }}</p>
                                                    <p class="mb-0"><i class="fas fa-user me-2 text-primary"></i><strong>Name:</strong> {{ $progress->user->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h6 class="card-title text-primary">Progress Details</h6>
                                                <div class="mt-3">
                                                    <p class="mb-2"><i class="fas fa-tag me-2 text-primary"></i><strong>Category:</strong> {{ $progress->category }}</p>
                                                    <p class="mb-2"><i class="fas fa-heading me-2 text-primary"></i><strong>Title:</strong> {{ $progress->title }}</p>
                                                    <p class="mb-2"><i class="fas fa-align-left me-2 text-primary"></i><strong>Description:</strong> {{ $progress->description }}</p>
                                                    @if($progress->attachments->count() > 0)
                                                    <div class="mb-0">
                                                        <i class="fas fa-paperclip me-2 text-primary"></i>
                                                        <strong>Attachments:</strong>
                                                        <div class="mt-2">
                                                            @foreach($progress->attachments as $attachment)
                                                            <div class="d-flex align-items-center mb-2">
                                                                <i class="fas fa-file me-2 text-secondary"></i>
                                                                <span class="me-2">{{ $attachment->file_name }}</span>
                                                                <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-download me-1"></i>Download
                                                                </a>
                                                            </div>
                                                            @endforeach
                                                        </div>
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
                                                    <button type="submit" class="btn btn-primary w-100">
                                                        <i class="fas fa-save me-1"></i> Update Status
                                                    </button>
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
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>