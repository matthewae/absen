<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
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

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            background: var(--primary-color);
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

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: var(--transition);
            font-weight: 500;
            display: flex;
            align-items: center;
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

        .main-content {
            padding: 30px;
            background-color: var(--bg-light);
            margin-left: 250px;
        }

        .schedule-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        .table td {
            vertical-align: middle;
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
                    <a href="{{ route('work-progress.index') }}" class="nav-link {{ request()->routeIs('work-progress.index') ? 'active' : '' }}">
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

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <div class="schedule-container">
                    <h2 class="mb-4">My Schedule</h2>
                    <div class="calendar-container">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            
                        </div>
                        <div id="calendar" class="mb-4"></div>
                    </div>
                    
                    <style>
                    .calendar-container {
                        background: white;
                        border-radius: 10px;
                        padding: 25px;
                        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                        margin-left: 20px;
                    }
                    
                    .fc {
                        background: white;
                        padding: 20px;
                        border-radius: 8px;
                    }
                    
                    .fc .fc-toolbar {
                        margin-bottom: 2em;
                    }
                    
                    .fc .fc-toolbar-title {
                        font-size: 1.5em;
                        font-weight: 600;
                    }
                    
                    .fc .fc-button {
                        background-color: var(--primary-color);
                        border-color: var(--primary-color);
                        padding: 8px 16px;
                        font-weight: 500;
                        text-transform: capitalize;
                    }
                    
                    .fc .fc-button:hover {
                        background-color: var(--secondary-color);
                        border-color: var(--secondary-color);
                    }
                    
                    .fc .fc-button-primary:not(:disabled).fc-button-active,
                    .fc .fc-button-primary:not(:disabled):active {
                        background-color: var(--secondary-color);
                        border-color: var(--secondary-color);
                    }
                    
                    .fc-daygrid-day {
                        transition: background-color 0.2s;
                    }
                    
                    .fc-daygrid-day:hover {
                        background-color: rgba(0,0,0,0.02);
                    }
                    
                    .fc .fc-daygrid-day.fc-day-today {
                        background-color: rgba(255,215,0,0.1);
                    }
                    
                    .fc-event {
                        border: none;
                        padding: 2px 4px;
                        font-size: 0.85em;
                        border-radius: 4px;
                    }
                    </style>
                    
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Activity</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->date->format('l') }}</td>
                                    <td>{{ $attendance->time_in ? $attendance->time_in->format('H:i') : 'N/A' }} - {{ $attendance->time_out ? $attendance->time_out->format('H:i') : 'N/A' }}</td>
                                    <td>{{ ucfirst($attendance->notes ?? 'Regular Schedule') }}</td>
                                    <td><span class="badge bg-{{ $attendance->status === 'present' ? 'success' : ($attendance->status === 'late' ? 'warning' : 'danger') }}">{{ ucfirst($attendance->status) }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                events: '/schedules',
                eventDisplay: 'block',
                height: 700,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false,
                    hour12: false
                },
                eventDidMount: function(info) {
                    if (info.event.extendedProps.type) {
                        info.el.style.backgroundColor = getEventColor(info.event.extendedProps.type);
                    }
                }
            });
            calendar.render();
        });

        function getEventColor(type) {
            const colors = {
                'meeting': '#4CAF50',
                'task': '#2196F3',
                'deadline': '#f44336',
                'training': '#9C27B0',
                'default': '#607D8B'
            };
            return colors[type.toLowerCase()] || colors.default;
        }
    </script>

</body>

</html>