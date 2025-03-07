<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT. Mandajaya - Dashboard</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Calendar -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet'>
    
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
            font-family: 'Figtree', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-color);
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            background: var(--primary-color);
            color: white;
            padding: 1rem;
            transition: var(--transition);
            z-index: 1000;
        }
        
        .sidebar-brand {
            padding: 1.5rem 1rem;
            color: var(--accent-color);
            font-weight: 700;
            font-size: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-section {
            margin-bottom: 2rem;
        }

        .menu-item {
            padding: 0.75rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: var(--transition);
            border-radius: 0.75rem;
            margin: 0.25rem 0;
            font-weight: 500;
        }
        
        .menu-item:hover, .menu-item.active {
            background: rgba(255,255,255,0.1);
            color: var(--accent-color);
            transform: translateX(5px);
        }
        
        .menu-item i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
        
        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: var(--transition);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            background: var(--bg-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        /* Calendar Widget */
        .calendar-widget {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-top: 2rem;
        }
        
        /* Activity Feed */
        .activity-feed {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        
        .activity-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--bg-light);
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">PT. Mandajaya</div>
        <div class="sidebar-menu">
            <div class="menu-section mb-4">
                <small class="text-light text-uppercase ps-3 mb-2 d-block">Main Menu</small>
                <a href="{{ route('home') }}" class="menu-item {{ Request::is('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
                <a href="{{ route('attendance') }}" class="menu-item {{ Request::is('attendance') ? 'active' : '' }}">
                    <i class="fas fa-clock"></i>
                    Attendance
                </a>
                <a href="{{ route('schedule') }}" class="menu-item {{ Request::is('schedule') ? 'active' : '' }}">
                    <i class="fas fa-calendar"></i>
                    Schedule
                </a>
            </div>
            
            <div class="menu-section">
                <small class="text-light text-uppercase ps-3 mb-2 d-block">Account</small>
                <a href="{{ route('profile.index') }}" class="menu-item {{ Request::is('profile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                    Profile
                </a>
                <a href="{{ route('set') }}" class="menu-item {{ Request::is('set') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-item text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            <div class="profile-section">
                <div class="profile-info">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p class="profile-name">{{ Auth::user()->name }}</p>
                        <p class="profile-email">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card profile-card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="profile-photo text-center">
                                    <img src="{{ Auth::user()->profile_photo ?? '/images/default-profile.jpg' }}" alt="Profile Photo" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
                                    <h4 class="mt-3 mb-1 text-primary fw-bold">{{ Auth::user()->name }}</h4>
                                    <p class="text-muted">{{ Auth::user()->role }}</p>
                                </div>
                                <div class="status-badges">
                                    <span class="badge bg-success mb-2 d-block">Active Employee</span>
                                    <span class="badge bg-info d-block">{{ Auth::user()->department ?? 'Not Assigned' }}</span>
                                </div>
                            </div>
                            <div class="info-section">
                                <h5 class="section-title mb-4">Employee Information</h5>
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope me-3 text-primary"></i>
                                        <div>
                                            <label class="text-muted small mb-0">Email Address</label>
                                            <div class="fw-medium">{{ Auth::user()->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-id-card me-3 text-primary"></i>
                                        <div>
                                            <label class="text-muted small mb-0">Employee ID</label>
                                            <div class="fw-medium">{{ Auth::user()->staff_id }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-building me-3 text-primary"></i>
                                        <div>
                                            <label class="text-muted small mb-0">Department</label>
                                            <div class="fw-medium">{{ Auth::user()->department ?? 'Not Assigned' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-tie me-3 text-primary"></i>
                                        <div>
                                            <label class="text-muted small mb-0">Position</label>
                                            <div class="fw-medium">{{ Auth::user()->role }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item mb-3">
                                    <label>Role:</label>
                                    <div>{{ Auth::user()->role }}</div>
                                </div>
                                <div class="info-item mb-3">
                                    <label>Sisa Cuti Tahunan:</label>
                                    <div>{{ Auth::user()->annual_leave ?? 0 }} (Kebijakan Cuti Tahunan: 12 hari)</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="text-primary mb-4">Ongoing Projects</h4>
        </div>
        <!-- Project Card 1 -->
        <div class="col-md-6 mb-4">
            <div class="card project-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Office Building Renovation</h5>
                        <span class="badge bg-primary">In Progress</span>
                    </div>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="text-muted mb-3">75% Complete</p>
                    <div class="project-details">
                        <div class="mb-2">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            <span>Deadline: March 15, 2024</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-users me-2 text-primary"></i>
                            <span>Team: 8 members</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">Next Milestone: Interior finishing (Feb 1)</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project Card 2 -->
        <div class="col-md-6 mb-4">
            <div class="card project-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Shopping Mall Construction</h5>
                        <span class="badge bg-warning">Planning</span>
                    </div>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="text-muted mb-3">30% Complete</p>
                    <div class="project-details">
                        <div class="mb-2">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            <span>Deadline: December 20, 2024</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-users me-2 text-primary"></i>
                            <span>Team: 15 members</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">Next Milestone: Foundation work (Feb 15)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project Timeline -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Project Timeline</h5>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Office Building: Interior Design Review</h6>
                                <small class="text-muted">January 25, 2024</small>
                                <p class="mt-2">Team meeting to finalize interior design specifications</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Shopping Mall: Site Survey Complete</h6>
                                <small class="text-muted">January 20, 2024</small>
                                <p class="mt-2">Environmental impact assessment and site survey finalized</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    {
                        title: 'Team Meeting',
                        start: '2024-01-15'
                    },
                    {
                        title: 'Holiday',
                        start: '2024-01-01',
                        end: '2024-01-02'
                    }
                ]
            });
            calendar.render();
        });
    </script>
</body>
</html>
<style>
    .profile-card {
        border-radius: 20px;
        overflow: hidden;
        background: white;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
    }

    .profile-card:hover {
        transform: var(--hover-transform);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .profile-photo img {
        border: 5px solid var(--accent-color);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        transition: var(--transition);
    }

    .profile-photo img:hover {
        transform: scale(1.05);
    }
    
    .info-section {
        padding: 2rem;
        background: linear-gradient(to bottom, white, var(--bg-light));
    }
    
    .info-item label {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0.25rem;
    }
    
    .info-item div {
        color: var(--text-color);
    }
    
    h5 {
        color: var(--primary-color);
        font-weight: 600;
    }
</style>
<div class="col-md-8">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="text-primary mb-4">Ongoing Projects</h4>
        </div>
        <!-- Project Card 1 -->
        <div class="col-md-6 mb-4">
            <div class="card project-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Office Building Renovation</h5>
                        <span class="badge bg-primary">In Progress</span>
                    </div>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="text-muted mb-3">75% Complete</p>
                    <div class="project-details">
                        <div class="mb-2">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            <span>Deadline: March 15, 2024</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-users me-2 text-primary"></i>
                            <span>Team: 8 members</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">Next Milestone: Interior finishing (Feb 1)</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project Card 2 -->
        <div class="col-md-6 mb-4">
            <div class="card project-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Shopping Mall Construction</h5>
                        <span class="badge bg-warning">Planning</span>
                    </div>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="text-muted mb-3">30% Complete</p>
                    <div class="project-details">
                        <div class="mb-2">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            <span>Deadline: December 20, 2024</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-users me-2 text-primary"></i>
                            <span>Team: 15 members</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">Next Milestone: Foundation work (Feb 15)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project Timeline -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Project Timeline</h5>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Office Building: Interior Design Review</h6>
                                <small class="text-muted">January 25, 2024</small>
                                <p class="mt-2">Team meeting to finalize interior design specifications</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Shopping Mall: Site Survey Complete</h6>
                                <small class="text-muted">January 20, 2024</small>
                                <p class="mt-2">Environmental impact assessment and site survey finalized</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.project-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.project-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
}

.progress {
    border-radius: 10px;
    background-color: #e9ecef;
}

.progress-bar {
    border-radius: 10px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
}

.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline-item {
    position: relative;
    padding-left: 40px;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: 0;
    top: 0;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px var(--primary-color);
}

.timeline-content {
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.badge {
    padding: 0.5em 1em;
    font-weight: 500;
}
</style>
<style>
.project-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.project-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
}

.progress {
    border-radius: 10px;
    background-color: #e9ecef;
}

.progress-bar {
    border-radius: 10px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
}

.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline-item {
    position: relative;
    padding-left: 40px;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: 0;
    top: 0;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px var(--primary-color);
}

.timeline-content {
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.badge {
    padding: 0.5em 1em;
    font-weight: 500;
}
</style>
</body>
</html>