<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('PROFIL PEGAWAI') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            min-height: 100vh;
            width: 250px;
            background-color: var(--primary-color);
            color: white;
            padding-top: 20px;
            transition: var(--transition);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar h4 {
            color: var(--accent-color);
            font-weight: 700;
            padding: 0 20px;
            margin-bottom: 30px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
        }

        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background-color: var(--secondary-color);
            color: var(--accent-color);
        }

        .sidebar-nav i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 250px;
            padding: 2rem;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .profile-photo img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s;
        }

        .profile-photo img:hover {
            transform: scale(1.05);
        }

        .information-section label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.2rem;
        }

        .information-section p {
            margin-bottom: 1rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h4>ABSEN System</h4>
            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('primary') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.index') }}" class="nav-link active">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="{{ route('attendance.index') }}" class="nav-link">
                        <i class="fas fa-clock"></i>
                        Attendance
                    </a>
                </li>
                <li>
                    <a href="{{ route('schedule.index') }}" class="nav-link">
                        <i class="fas fa-calendar"></i>
                        Schedule
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings.index') }}" class="nav-link">
                        <i class="fas fa-cog"></i>
                        Settings
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="profile-card">
                            <div class="card-header bg-primary text-white text-center py-3">
                                <h4 class="mb-0">{{ __('PROFIL PEGAWAI') }}</h4>
                            </div>

                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <div class="profile-photo mb-3">
                                        <img src="{{ asset('storage/profile-photos/' . ($user->photo ?? 'default.jpg')) }}" 
                                             class="rounded-circle img-thumbnail" 
                                             alt="Profile Photo">
                                    </div>
                                    <h3 class="mb-0 text-primary">{{ $user->name }}</h3>
                                    <p class="text-muted">NIK: {{ $user->nik ?? 'Not set' }}</p>
                                </div>

                                <div class="information-section">
                                    <h5 class="border-bottom pb-2 mb-4 text-primary">{{ __('INFORMASI') }}</h5>
                                    
                                    <div class="info-item mb-3">
                                        <label>{{ __('Email Pegawai') }}</label>
                                        <p class="h6">{{ $user->email }}</p>
                                    </div>

                                    <div class="info-item mb-3">
                                        <label>{{ __('Nama Pegawai') }}</label>
                                        <p class="h6">{{ $user->name }}</p>
                                    </div>

                                    <div class="info-item mb-3">
                                        <label>{{ __('NIK') }}</label>
                                        <p class="h6">{{ $user->nik ?? 'Not set' }}</p>
                                    </div>

                                    <div class="info-item mb-3">
                                        <label>{{ __('Unit Kerja') }}</label>
                                        <p class="h6">{{ $user->department ?? 'Not set' }}</p>
                                    </div>

                                    <div class="info-item mb-3">
                                        <label>{{ __('Sisa Cuti Tahunan') }}</label>
                                        <p class="h6">{{ $user->remaining_leave ?? '0' }} {{ __('Hari') }}</p>
                                    </div>

                                    <div class="info-item mb-3">
                                        <label>{{ __('Sisa Cuti Besar') }}</label>
                                        <p class="h6">{{ $user->remaining_big_leave ?? '0' }} {{ __('Hari') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>