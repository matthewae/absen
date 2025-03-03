@extends('layouts.dashboard')

@section('dashboard-content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Work Progress</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorkProgressModal">
            <i class="fas fa-plus"></i> Add New Progress
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Work Description</th>
                            <th>Proof</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($workProgress ?? [] as $progress)
                        <tr>
                            <td>{{ $progress->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $progress->description }}</td>
                            <td>
                                @if($progress->proof)
                                    <a href="{{ asset('storage/' . $progress->proof) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-file"></i> View File
                                    </a>
                                @else
                                    <span class="text-muted">No file attached</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $progress->status_color }}">{{ $progress->status }}</span>
                            </td>
                            <td>
                                <form action="{{ route('work-progress.edit', $progress->id) }}" method="GET" class="d-inline">
                                    <button type="submit" class="btn btn-sm btn-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </form>
                                <form action="{{ route('work-progress.destroy', $progress->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this progress?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No work progress records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Work Progress Modal -->
<div class="modal fade" id="addWorkProgressModal" tabindex="-1" aria-labelledby="addWorkProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWorkProgressModalLabel">Add Work Progress</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('work-progress.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="description" class="form-label">Work Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="proof" class="form-label">Proof of Work</label>
                        <input type="file" class="form-control" id="proof" name="proof" accept=".pdf,.jpg,.jpeg,.png,.gif">
                        <small class="text-muted">Accepted formats: PDF, JPG, JPEG, PNG, GIF</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Progress</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.table th {
    font-weight: 600;
    background-color: #f8f9fa;
}

.badge {
    padding: 0.5em 1em;
}

.modal-content {
    border: none;
    border-radius: 10px;
}

.btn-close:focus {
    box-shadow: none;
}
</style>

<script>
function editProgress(id) {
    // Implement edit functionality
    console.log('Edit progress:', id);
}

function deleteProgress(id) {
    if (confirm('Are you sure you want to delete this progress?')) {
        // Implement delete functionality
        console.log('Delete progress:', id);
    }
}
</script>
@endsection