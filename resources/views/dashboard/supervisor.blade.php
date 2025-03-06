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
            --primary-color: #0d6efd;
            --success-color: #198754;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #0dcaf0;
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        .container-fluid {
            max-width: 1600px;
        }
        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.2s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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
            color: #495057;
        }
        .badge {
            font-weight: 500;
            padding: 0.5em 1em;
        }
        .btn-primary {
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
        }
        .modal-content {
            border: none;
            border-radius: 15px;
        }
        .modal-header {
            border-radius: 15px 15px 0 0;
            border-bottom: none;
        }
        @media print {
            .btn, .modal {
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
    </style>
</head>
<body>
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">Supervisor Dashboard</h2>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Print Report
                </button>
            </div>
        </div>

        <div class="row">
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
                                            <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : 'danger' }} rounded-pill px-3">
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
                                            @if($progress->attachment)
                                            <p class="mb-0">
                                                <i class="fas fa-paperclip me-2 text-primary"></i>
                                                <strong>Attachment:</strong> 
                                                <a href="{{ asset('storage/' . $progress->attachment) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                                                    <i class="fas fa-download me-1"></i>Download
                                                </a>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <h6 class="card-title text-primary">Status Update</h6>
                                <form action="{{ route('work-progress.update-status', $progress->id) }}" method="POST" class="mt-3">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>