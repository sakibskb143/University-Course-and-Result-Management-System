<!doctype html>
<html lang="en">

<head>
    <title>Student Dashboard - University CMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0cd1eac34e.js" crossorigin="anonymous"></script>

    <style>
        :root {
            --primary-color: rgba(18, 88, 117, 0.9);
            --accent-color: rgb(255, 115, 80);
        }

        body {
            font-family: "Open Sans", sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: #E5E5E5;
            color: var(--primary-color);
        }

        .sidebar .nav-link {
            color: var(--primary-color);
            font-weight: 500;
            padding: 10px 15px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--primary-color);
            border-radius: 5px;
            color: white;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .fa-graduation-cap {
            color: var(--accent-color);
            font-size: 32px;
        }

        .brand-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--accent-color);
        }

        .brand-title span {
            color: var(--primary-color);
        }

        .brand-title .highlight {
            color: var(--accent-color);
        }

        .top-bar {
            background: white;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-info i {
            font-size: 30px;
            color: var(--primary-color);
        }

        .admin-details small {
            display: block;
            font-size: 12px;
            color: gray;
        }

        .primary-color {
            color: var(--primary-color);
        }

        .bg-clr-1 { background-color: var(--primary-color); }
        .bg-clr-2 { background-color: #84AE92; }
        .bg-clr-3 { background-color: #987070; }
    </style>
</head>

<body>

@php
    $enrollments = $enrollments ?? collect();
    $availableCourses = $availableCourses ?? collect();
    $schedule = $schedule ?? collect();
    $summary = $summary ?? ['enrolledCount'=>0,'totalCredits'=>0,'cgpa'=>null];
    $user = $user ?? auth()->user();
@endphp

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <div class="mb-4">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <i class="fa-solid fa-graduation-cap me-2"></i>
                    <span class="brand-title">
                        <span>P</span><span class="highlight">UC</span>
                    </span>
                </a>
            </div>
            <ul class="nav flex-column gap-1">
                <li class="nav-item"><a href="#" class="nav-link active" data-target="dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-target="enroll"><i class="fa-solid fa-book"></i> Enroll in Courses</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-target="results"><i class="fa-solid fa-chart-line"></i> View Result</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-target="schedule"><i class="fa-solid fa-calendar"></i> Class Schedule</a></li>
                <li class="mt-4 border-top pt-2 nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-0">
            <!-- Top Bar -->
            <div class="top-bar">
                <h5 class="m-3 fs-2 uppercase primary-color fw-bold">Student Dashboard</h5>
                <div class="admin-info">
                    <i class="fa-solid fa-user-circle"></i>
                    <div class="admin-details primary-color">
                        <strong>{{ $user->name ?? 'Student' }}</strong>
                        <small>{{ $user->email ?? '' }}</small>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <!-- Dashboard Overview -->
                <div id="dashboard" class="content-section active">
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card shadow-sm p-3 bg-clr-1 text-white">
                                <h5>Enrolled Courses</h5>
                                <h2>{{ $summary['enrolledCount'] ?? 0 }}</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm p-3 bg-clr-2 text-white">
                                <h5>CGPA</h5>
                                <h2>{{ $summary['cgpa'] ?? 'N/A' }}</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm p-3 bg-clr-3 text-white">
                                <h5>Credits</h5>
                                <h2>{{ $summary['totalCredits'] ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enroll in Courses -->
                <div id="enroll" class="content-section">
                    <h4>Enroll in Courses</h4>
                    <p>Select your preferred courses for the semester.</p>
                    @if(isset($availableCourses) && count($availableCourses))
                        <form method="GET" action="{{ route('student.dashboard') }}">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <label class="fw-semibold">Exam Type:</label>
                                <select name="exam_type" class="form-select form-select-sm" style="width:auto;">
                                    <option value="Regular">Regular</option>
                                    <option value="Recourse">Recourse</option>
                                    <option value="Retake">Retake</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Enroll Selected</button>
                            </div>
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:40px;"><input type="checkbox" id="checkAll"></th>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Credits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($availableCourses as $course)
                                        <tr>
                                            <td><input type="checkbox" name="enroll_course_ids[]" value="{{ $course->id }}" class="row-check"></td>
                                            <td>{{ $course->course_code }}</td>
                                            <td>{{ $course->course_name }}</td>
                                            <td>{{ $course->credit }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    @else
                        <div class="alert alert-info">No courses available to enroll at this time.</div>
                    @endif

                    <h5 class="mt-4">My Enrollments</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Credits</th>
                                    <th>Exam Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enrollments as $en)
                                    <tr>
                                        <td>{{ $en->course_code }}</td>
                                        <td>{{ $en->course_name }}</td>
                                        <td>{{ $en->credit }}</td>
                                        <td>{{ $en->exam_type }}</td>
                                        <td>{{ $en->status }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5">No enrollments yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- View Results -->
                <div id="results" class="content-section">
                    <h4>View Result</h4>
                    <div class="alert alert-secondary">Use the sidebar link to view published results.</div>
                </div>

                <!-- Class Schedule -->
                <div id="schedule" class="content-section">
                    <h4>Class Schedule</h4>
                    @if(isset($schedule) && count($schedule))
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Course</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Room</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedule as $slot)
                                    <tr>
                                        <td>{{ optional($slot->course)->course_code }} - {{ optional($slot->course)->course_name }}</td>
                                        <td>{{ $slot->day }}</td>
                                        <td>{{ $slot->time_from }} - {{ $slot->time_to }}</td>
                                        <td>{{ optional($slot->room)->room_no }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">No schedule found for your department/semester.</div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.sidebar .nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.sidebar .nav-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            document.querySelectorAll('.content-section').forEach(sec => sec.classList.remove('active'));
            const target = this.getAttribute('data-target');
            if (target) {
                document.getElementById(target).classList.add('active');
            }
        });
    });

    const checkAll = document.getElementById('checkAll');
    if (checkAll) {
        checkAll.addEventListener('change', function() {
            document.querySelectorAll('.row-check').forEach(cb => { cb.checked = checkAll.checked; });
        });
    }
</script>

</body>
</html>
