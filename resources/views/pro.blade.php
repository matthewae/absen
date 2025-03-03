<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #2c3e50;
        }
        body {
            background-color: #f8f9fa;
        }
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--primary-color);
            position: fixed;
            left: 0;
            top: 0;
            padding: 1rem;
        }
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: #FFD700;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            border-radius: 1rem;
        }
        .profile-photo {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky">
                    <h4 class="text-white mb-4">{{ config('app.name', 'Laravel') }}</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('primary') }}">
                                <i class="fas fa-home me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('attendance.index') }}">
                                <i class="fas fa-clock me-2"></i>
                                Attendance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('schedule') }}">
                                <i class="fas fa-calendar me-2"></i>
                                Schedule
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('work-progress') }}">
                                <i class="fas fa-tasks me-2"></i>
                                Work Progress
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profile.index') }}">
                                <i class="fas fa-user me-2"></i>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('settings') }}">
                                <i class="fas fa-cog me-2"></i>
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Profile Information</h1>
                </div>

                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ asset('storage/profile-photos/' . Auth::user()->photo) }}" 
                                     alt="Profile Photo" 
                                     class="profile-photo mb-3">
                                <h4 class="card-title">{{ Auth::user()->name }}</h4>
                                <p class="card-text text-muted">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Personal Information</h5>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->name }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->email }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Department</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->department ?? 'Not set' }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Position</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->position ?? 'Not set' }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Birth Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->birth_date ? date('d F Y', strtotime(Auth::user()->birth_date)) : 'Not set' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Join Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ date('d F Y', strtotime(Auth::user()->created_at)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>