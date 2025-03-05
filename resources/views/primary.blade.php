<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
        }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
            background-color: var(--bg-light);
            color: var(--text-color);
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

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            padding: 30px;
            background-color: var(--bg-light);
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .stats-card h5 {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .stats-card .h3 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0;
        }

        .calendar {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .calendar-table {
            border-collapse: separate;
            border-spacing: 3px;
        }

        .calendar-table th {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 10px;
            font-weight: 500;
            border-radius: 5px;
        }

        .calendar-table td {
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 0;
            position: relative;
        }

        .calendar-table td:hover {
            border-color: var(--primary-color);
        }

        .date-number {
            font-weight: 500;
            color: var(--text-color);
        }

        .event-dots {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 3px;
        }

        .event-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: var(--primary-color);
        }

        .calendar h4 {
            color: var(--primary-color);
            font-weight: 600;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 8px;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 8px;
            transition: var(--transition);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-secondary {
            padding: 8px 15px;
            font-size: 0.9rem;
        }

        .table th {
            font-weight: 600;
            color: var(--primary-color);
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

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <!-- Welcome Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Welcome back, {{ Auth::user()->name }}!</h2>
                    <div class="quick-actions">
                        <form action="{{ route('attendance.store') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-plus"></i> Record Attendance
                            </button>
                        </form>
                        <button class="btn btn-outline-primary" onclick="window.location.href='{{ route('jdwl') }}'">
                            <i class="fas fa-calendar-plus"></i> View Schedule
                        </button>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <h5>Today's Attendance</h5>
                            <p class="h3 mb-0">
                                @php
                                    $todayAttendance = \App\Models\Attendance::where('user_id', auth()->id())
                                        ->whereDate('date', \Carbon\Carbon::today())
                                        ->first();
                                @endphp
                                @if($todayAttendance)
                                    @if($todayAttendance->time_out)
                                        Checked Out
                                    @else
                                        Checked In
                                    @endif
                                @else
                                    Not Checked In
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <h5>Present Days</h5>
                            <p class="h3 mb-0">0</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <h5>Work Hours</h5>
                            <p class="h3 mb-0">0h</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <h5>Tasks Completed</h5>
                            <p class="h3 mb-0">0</p>
                        </div>
                    </div>
                </div>

                <!-- Calendar Section -->
                <div class="calendar">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-secondary me-2" id="prevMonth">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <h4 class="mb-0">March 2025</h4>
                            <button class="btn btn-outline-secondary ms-2" id="nextMonth">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-outline-secondary me-2">Month</button>
                            <button class="btn btn-sm btn-outline-secondary me-2">Week</button>
                            <button class="btn btn-sm btn-outline-secondary">Day</button>
                        </div>
                    </div>
                    <!-- Calendar Grid -->
                    <div class="table-responsive">
                        <table class="table table-bordered calendar-table">
                            <thead>
                                <tr>
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </tr>
                            </thead>
                            <tbody id="calendar-body">
                                <!-- Calendar days will be dynamically populated -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarBody = document.getElementById('calendar-body');
            const today = new Date();
            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();

            // Add event listeners for month navigation
            document.getElementById('prevMonth').addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                generateCalendar(currentMonth, currentYear);
            });

            document.getElementById('nextMonth').addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                generateCalendar(currentMonth, currentYear);
            });

            function generateCalendar(month, year) {
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const startingDay = firstDay.getDay();
                const monthLength = lastDay.getDate();
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                // Clear previous calendar
                calendarBody.innerHTML = '';

                let date = 1;
                for (let i = 0; i < 6; i++) {
                    const row = document.createElement('tr');

                    for (let j = 0; j < 7; j++) {
                        const cell = document.createElement('td');
                        cell.style.height = '80px';
                        cell.style.verticalAlign = 'top';
                        cell.style.cursor = 'pointer';
                        cell.style.transition = 'all 0.2s ease';

                        if (i === 0 && j < startingDay) {
                            // Empty cells before the first day
                            cell.classList.add('bg-light');
                        } else if (date > monthLength) {
                            // Empty cells after the last day
                            cell.classList.add('bg-light');
                        } else {
                            const currentDate = new Date(year, month, date);
                            const dayName = currentDate.toLocaleDateString('en-US', { weekday: 'short' });
                            const isSunday = currentDate.getDay() === 0;
                            const dateColor = isSunday ? 'text-danger' : '';
                            
                            cell.innerHTML = `<div class="d-flex justify-content-between align-items-start p-1">
                                                <div>
                                                    <span class="date-number ${dateColor}">${date}</span>
                                                    <div class="small text-muted ${dateColor}">${dayName}</div>
                                                </div>
                                                <span class="badge bg-primary d-none">2</span>
                                            </div>
                                            <div class="event-dots"></div>`;

                            // Highlight today's date
                            if (date === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                                cell.classList.add('bg-warning', 'bg-opacity-25');
                            }

                            // Add hover effect
                            cell.addEventListener('mouseover', function() {
                                this.classList.add('bg-primary', 'bg-opacity-10');
                            });

                            cell.addEventListener('mouseout', function() {
                                if (!(date === today.getDate() && month === today.getMonth() && year === today.getFullYear())) {
                                    this.classList.remove('bg-primary', 'bg-opacity-10');
                                }
                            });

                            // Add click event
                            cell.addEventListener('click', function() {
                                const selectedDate = new Date(year, month, date);
                                handleDateClick(selectedDate);
                            });

                            date++;
                        }
                        row.appendChild(cell);
                    }
                    calendarBody.appendChild(row);
                    if (date > monthLength) break;
                }

                // Update calendar header
                document.querySelector('.calendar h4').textContent = `${monthNames[month]} ${year}`;
            }

            // Initialize calendar
            generateCalendar(currentMonth, currentYear);

            // Function to handle view changes
            function changeView(view) {
                const calendarContainer = document.querySelector('.calendar');
                const today = new Date();

                switch(view) {
                    case 'month':
                        generateCalendar(currentMonth, currentYear);
                        break;
                    case 'week':
                        // Clear existing calendar
                        calendarBody.innerHTML = '';
                        
                        // Get current week's Sunday
                        const currentDate = new Date(currentYear, currentMonth, today.getDate());
                        const firstDayOfWeek = new Date(currentDate);
                        firstDayOfWeek.setDate(currentDate.getDate() - currentDate.getDay());

                        // Create week view
                        const weekRow = document.createElement('tr');
                        for (let i = 0; i < 7; i++) {
                            const cell = document.createElement('td');
                            const currentDay = new Date(firstDayOfWeek);
                            currentDay.setDate(firstDayOfWeek.getDate() + i);

                            cell.style.height = '300px';
                            cell.style.verticalAlign = 'top';
                            cell.innerHTML = `
                                <div class="p-2">
                                    <div class="fw-bold">${currentDay.getDate()}</div>
                                    <div class="text-muted small">${currentDay.toLocaleDateString('en-US', { weekday: 'short' })}</div>
                                </div>
                            `;

                            if (currentDay.toDateString() === today.toDateString()) {
                                cell.classList.add('bg-warning', 'bg-opacity-25');
                            }

                            weekRow.appendChild(cell);
                        }
                        calendarBody.appendChild(weekRow);

                        // Update header
                        document.querySelector('.calendar h4').textContent = `Week of ${firstDayOfWeek.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}`;
                        break;
                    case 'day':
                        // Clear existing calendar
                        calendarBody.innerHTML = '';
                        
                        // Create day view
                        const dayRow = document.createElement('tr');
                        const dayCell = document.createElement('td');
                        dayCell.style.height = '500px';
                        dayCell.style.width = '100%';
                        dayCell.colSpan = 7;
                        
                        // Add hourly slots
                        let hoursHtml = '';
                        for (let hour = 0; hour < 24; hour++) {
                            const timeString = `${hour.toString().padStart(2, '0')}:00`;
                            hoursHtml += `
                                <div class="hour-slot py-2 border-bottom" style="height: 60px;">
                                    <div class="text-muted small">${timeString}</div>
                                </div>
                            `;
                        }
                        dayCell.innerHTML = hoursHtml;
                        
                        dayRow.appendChild(dayCell);
                        calendarBody.appendChild(dayRow);

                        // Update header
                        document.querySelector('.calendar h4').textContent = today.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' });
                        break;
                }
            }

            // Function to handle date clicks
            function handleDateClick(date) {
                console.log('Selected date:', date.toLocaleDateString());
                // Add your custom date click handling logic here
            }

            // Add event listeners for view buttons
            document.querySelectorAll('.btn-outline-secondary').forEach(button => {
                button.addEventListener('click', function() {
                    const view = this.textContent.trim().toLowerCase();
                    changeView(view);
                });
            });
        });
    </script>
</body>

</html>