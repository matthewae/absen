<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #FFD700;
            --text-color: #2c3e50;
            --bg-light: #f8f9fa;
            --transition: all 0.3s ease;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --hover-transform: translateY(-5px);
        }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
            background-color: var(--bg-light);
            color: var(--text-color);
            letter-spacing: 0.025em;
            line-height: 1.6;
        }

        .sidebar {
            min-height: 100vh;
            background-color: var(--primary-color);
            color: white;
            padding-top: 20px;
            transition: var(--transition);
        }

        .sidebar h4 {
            color: var(--accent-color);
            font-weight: 700;
            padding: 0 20px;
            margin-bottom: 30px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: var(--transition);
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: var(--secondary-color);
            color: var(--accent-color);
            transform: translateX(5px);
        }

        .main-content {
            padding: 30px;
            background-color: var(--bg-light);
        }

        .card {
            border: none;
            box-shadow: var(--card-shadow);
            border-radius: 1.5rem;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: var(--hover-transform);
        }

        .profile-photo {
            width: 300px;
            height: 400px;
            object-fit: cover;
            border: 4px solid white;
            border-radius: 1.5rem;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            filter: brightness(1.02);
        }

        .profile-photo:hover {
            transform: var(--hover-transform);
            filter: brightness(1.05);
        }

        .personal-info h6 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .text-secondary {
            color: #6c757d !important;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: var(--transition);
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            letter-spacing: 0.025em;
            border-radius: 0.75rem;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-1px);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
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
    
            <!-- Main content -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                    <h1 class="h2">Profile Information</h1>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card text-center p-5 mb-4">
                            <div class="card-body">
                                <div class="position-relative mb-4">
                                    <img src="{{ Auth::user()->photo ? 'data:image/jpeg;base64,'.Auth::user()->photo : 'https://via.placeholder.com/200x200' }}"
                                        alt="Profile Photo"
                                        class="profile-photo mb-3">
                                </div>
                                <h4 class="card-title mb-2">{{ Auth::user()->name }}</h4>
                                <p class="card-text text-secondary mb-0">{{ Auth::user()->position ?? 'Position Not Set' }}</p>
                                <p class="card-text text-secondary mb-3">{{ Auth::user()->department ?? 'Department Not Set' }}</p>
                                <form action="{{ route('profile.update-photo') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <label for="photo" class="btn btn-primary btn-sm w-auto px-3">
                                        <i class="fas fa-camera"></i> Change Photo
                                    </label>
                                    <input type="file" id="photo" name="photo" class="d-none" accept="image/*" onchange="this.form.submit()">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card h-100">
                            <div class="card-body p-5">
                                <h5 class="card-title mb-4">Personal Information</h5>
                                <div class="row g-4 personal-info animate__animated animate__fadeIn">
                                    <div class="col-sm-6">
                                        <h6>Full Name</h6>
                                        <p class="text-secondary">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>Email</h6>
                                        <p class="text-secondary">{{ Auth::user()->email }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>Department</h6>
                                        <p class="text-secondary">{{ Auth::user()->department ?? 'Not set' }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>Position</h6>
                                        <p class="text-secondary">{{ Auth::user()->position ?? 'Not set' }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>Birth Date</h6>
                                        <p class="text-secondary">{{ Auth::user()->birth_date ? date('d F Y', strtotime(Auth::user()->birth_date)) : 'Not set' }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>Annual Leave Quota</h6>
                                        <p class="text-secondary">{{ Auth::user()->annual_leave_quota }} days</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>Remaining Leave</h6>
                                        <p class="text-secondary">{{ Auth::user()->remaining_leave }} days</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>Used Leave</h6>
                                        <p class="text-secondary">{{ Auth::user()->used_leave }} days</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>