<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Work Progress</title>
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

        .form-label {
            font-weight: 500;
            color: var(--text-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 20px;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        .progress-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .status-completed {
            background-color: #28a745;
            color: white;
        }

        .status-in-progress {
            background-color: #ffc107;
            color: var(--text-color);
        }

        .status-pending {
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
            <a href="{{ route('work-progress') }}" class="nav-link {{ request()->routeIs('work-progress') ? 'active' : '' }}">
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
        <div class="card shadow mb-4">
            <div class="card-header">
                <h4 class="mb-0">Submit Work Progress</h4>
            </div>
            <div class="card-body">
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

                <div id="uploadSuccess" class="alert alert-success d-none" role="alert">
                    <i class="fas fa-check-circle me-2"></i>File uploaded successfully!
                </div>

                <form action="{{ route('work-progress.store') }}" method="POST" enctype="multipart/form-data" id="progressForm">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="in-progress" {{ old('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="attachment" class="form-label">Progress Document</label>
                        <input type="file" class="form-control @error('attachment') is-invalid @enderror" id="attachment" name="attachment" accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg" required>
                        @error('attachment')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="filePreview" class="mt-2 d-none">
                            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                            <p class="file-name mt-2"></p>
                        </div>
                        <small class="text-muted">Please select a file to enable submission</small>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Submit Progress</button>
                </form>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const attachmentInput = document.getElementById('attachment');
                    const submitBtn = document.getElementById('submitBtn');
                    const filePreview = document.getElementById('filePreview');
                    const previewImg = filePreview.querySelector('img');
                    const fileName = filePreview.querySelector('.file-name');
                    const form = document.getElementById('progressForm');
                    const requiredInputs = form.querySelectorAll('[required]');

                    attachmentInput.addEventListener('change', function() {
                        if (this.files && this.files[0]) {
                            const file = this.files[0];
                            if (file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    previewImg.src = e.target.result;
                                    previewImg.style.display = 'block';
                                    fileName.textContent = file.name;
                                    filePreview.classList.remove('d-none');
                                    document.getElementById('uploadSuccess').classList.remove('d-none');
                                }
                                reader.readAsDataURL(file);
                            } else {
                                previewImg.style.display = 'none';
                                fileName.textContent = file.name;
                                filePreview.classList.remove('d-none');
                                document.getElementById('uploadSuccess').classList.remove('d-none');
                            }
                            checkFormValidity();
                        } else {
                            filePreview.classList.add('d-none');
                            previewImg.src = '';
                            fileName.textContent = '';
                            document.getElementById('uploadSuccess').classList.add('d-none');
                            checkFormValidity();
                        }
                    });

                    function checkFormValidity() {
                        let isValid = true;
                        requiredInputs.forEach(input => {
                            if (!input.value.trim()) {
                                isValid = false;
                            }
                        });
                        if (!attachmentInput.files || !attachmentInput.files[0]) {
                            isValid = false;
                        }
                        submitBtn.disabled = !isValid;
                    }

                    requiredInputs.forEach(input => {
                        input.addEventListener('input', checkFormValidity);
                        input.addEventListener('change', checkFormValidity);
                    });

                    checkFormValidity();
                });
                </script>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header">
                <h4 class="mb-0">Progress History</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($workProgress as $progress)
                            <tr>
                                <td>{{ $progress->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $progress->title }}</td>
                                <td>{{ $progress->description }}</td>
                                <td>
                                    <span class="progress-status status-{{ $progress->status }}">
                                        {{ ucfirst($progress->status) }}
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>