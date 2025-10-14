@extends('teacher.layout')

@section('title', 'Dashboard')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
        </ol>
    </nav>

    <!-- Profile Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fa-solid fa-user me-2"></i>Teacher Profile</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="text-muted">Name</h6>
                                    <p class="fw-bold">{{ $user->name ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted">Email</h6>
                                    <p class="fw-bold">{{ $user->email ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted">Department</h6>
                                    <p class="fw-bold">{{ $teacher->department->department_name ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted">Designation</h6>
                                    <p class="fw-bold">{{ $teacher->designation ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted">Contact Number</h6>
                                    <p class="fw-bold">{{ $teacher->contact_no ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted">Credit to be Taken</h6>
                                    <p class="fw-bold">{{ $teacher->credit_to_be_taken ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="profile-avatar">
                                <i class="fa-solid fa-user-circle" style="font-size: 120px; color: var(--primary-color);"></i>
                            </div>
                            <a href="{{ route('teacher.profile') }}" class="btn btn-primary mt-3">
                                <i class="fa-solid fa-edit me-1"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Overview -->
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm p-3 bg-clr-1 text-white">
                <h5>Assigned Courses</h5>
                <h2>{{ $assignedCount }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3 bg-clr-2 text-white">
                <h5>Classes This Week</h5>
                <h2>{{ $weeklyClasses ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3 bg-clr-3 text-white">
                <h5>Results Saved</h5>
                <h2>{{ $resultsSaved ?? 0 }}</h2>
            </div>
        </div>
    </div>

    <!-- Recent Assignments -->
    @if($assignments->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fa-solid fa-book me-2"></i>Recent Course Assignments</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Department</th>
                                    <th>Assigned Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignments->take(5) as $assignment)
                                <tr>
                                    <td>{{ $assignment->course->course_code ?? 'N/A' }}</td>
                                    <td>{{ $assignment->course->course_name ?? 'N/A' }}</td>
                                    <td>{{ $assignment->department->department_name ?? 'N/A' }}</td>
                                    <td>{{ $assignment->assigned_credit ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($assignments->count() > 5)
                    <div class="text-center mt-3">
                        <a href="{{ route('teacher.assigned-classes') }}" class="btn btn-primary">
                            View All Assignments
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
