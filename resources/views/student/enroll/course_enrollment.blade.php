<!doctype html>
<html lang="en">
<head>
    <title>Course Enrollment - University CMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0cd1eac34e.js" crossorigin="anonymous"></script>
    
    <style>
        :root {
            --primary-color: rgba(18, 88, 117, 0.9);
            --accent-color: rgb(255, 115, 80);
        }
        body {
            font-family: "Open Sans", sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 24px;
        }
        .status-pending {
            background-color: #ffc107;
            color: #000;
        }
        .status-approved {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('student.dashboard') }}">
                <i class="fa-solid fa-graduation-cap me-2" style="color: var(--accent-color);"></i>
                <span>P</span><span style="color: var(--accent-color);">UC</span>
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('student.dashboard') }}">Back to Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: var(--primary-color); color: white;">
                        <h5 class="mb-0"><i class="fa-solid fa-book me-2"></i>Available Courses</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Credits</th>
                                        <th>Fee (BDT)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                    <tr>
                                        <td><strong>{{ $course->course_code }}</strong></td>
                                        <td>{{ $course->course_name }}</td>
                                        <td>{{ $course->credit }}</td>
                                        <td>{{ number_format($course->credit * 2100) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#enrollModal{{ $course->id }}">
                                                <i class="fa-solid fa-plus me-1"></i>Enroll
                                            </button>

                                            <!-- Enrollment Modal -->
                                            <div class="modal fade" id="enrollModal{{ $course->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('student.enroll.submit') }}">
                                                            @csrf
                                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Enroll in {{ $course->course_name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Course Details:</label>
                                                                    <p><strong>Code:</strong> {{ $course->course_code }}</p>
                                                                    <p><strong>Credits:</strong> {{ $course->credit }}</p>
                                                                    <p><strong>Fee:</strong> {{ number_format($course->credit * 2100) }} BDT</p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Exam Type:</label>
                                                                    <select name="exam_type" class="form-select" required>
                                                                        <option value="">Select Exam Type</option>
                                                                        <option value="Regular">Regular</option>
                                                                        <option value="Recourse">Recourse</option>
                                                                        <option value="Retake">Retake</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-primary">Confirm Enrollment</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: var(--accent-color); color: white;">
                        <h6 class="mb-0"><i class="fa-solid fa-list me-2"></i>My Enrollments</h6>
                    </div>
                    <div class="card-body">
                        @forelse($enrolledCourses as $enrollment)
                        <div class="border-bottom pb-2 mb-2">
                            <strong>{{ $enrollment->course->course_code }}</strong><br>
                            <small>{{ $enrollment->exam_type }}</small><br>
                            <span class="badge {{ $enrollment->status == 'Approved' ? 'status-approved' : 'status-pending' }}">
                                {{ $enrollment->status }}
                            </span>
                        </div>
                        @empty
                        <p class="text-muted">No enrollments yet</p>
                        @endforelse
                        
                        <div class="mt-3">
                            <a href="{{ route('student.my_enrollments') }}" class="btn btn-outline-primary btn-sm">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>