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
        
        .menu-item {
            padding: 0.75rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: var(--transition);
            border-radius: 0.5rem;
            margin: 0.25rem 0;
        }
        
        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: var(--accent-color);
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
            <a href="#" class="menu-item active">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-clock"></i>
                Attendance
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-calendar"></i>
                Schedule
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-user"></i>
                Profile
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-cog"></i>
                Settings
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2 class="mb-4">Dashboard</h2>
        
        <!-- Stats Row -->
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3 class="h5 mb-2">Present Today</h3>
                    <h2 class="mb-0">85%</h2>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <h3 class="h5 mb-2">Late Arrivals</h3>
                    <h2 class="mb-0">5</h2>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="h5 mb-2">On Leave</h3>
                    <h2 class="mb-0">3</h2>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="h5 mb-2">Attendance Rate</h3>
                    <h2 class="mb-0">92%</h2>
                </div>
            </div>
        </div>

        <!-- Calendar and Activity Feed Row -->
        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="calendar-widget">
                    <h3 class="h4 mb-4">Attendance Calendar</h3>
                    <div id="calendar"></div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="activity-feed">
                    <h3 class="h4 mb-4">Recent Activity</h3>
                    <div class="activity-item">
                        <h5 class="mb-1">John Doe</h5>
                        <p class="mb-0 text-muted">Checked in at 8:30 AM</p>
                    </div>
                    <div class="activity-item">
                        <h5 class="mb-1">Jane Smith</h5>
                        <p class="mb-0 text-muted">Requested leave for tomorrow</p>
                    </div>
                    <div class="activity-item">
                        <h5 class="mb-1">Mike Johnson</h5>
                        <p class="mb-0 text-muted">Checked out at 5:00 PM</p>
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