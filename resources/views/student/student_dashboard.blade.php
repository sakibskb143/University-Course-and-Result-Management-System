@extends('student.layout')

@section('title', 'Student Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-white" style="background:#125875;">
                <h6 class="mb-1">Enrolled Courses</h6>
                <h2 class="mb-0">{{ $enrolledCourses }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-white" style="background:#84AE92;">
                <h6 class="mb-1">Completed Courses</h6>
                <h2 class="mb-0">{{ $completedCourses }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-white" style="background:#FF7350;">
                <h6 class="mb-1">Current Semester</h6>
                <h2 class="mb-0">{{ $currentSemesterEnrollments }}</h2>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-2">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-semibold">Class Schedule</div>
                <div class="card-body">
                    <p class="text-muted">View your class schedule for enrolled courses.</p>
                    <a href="{{ route('student.class-schedule') }}" class="btn btn-primary btn-sm">View Schedule</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-semibold">Enroll in Courses</div>
                <div class="card-body">
                    <p class="text-muted">Browse and enroll in available courses.</p>
                    <a href="{{ route('student.enroll-courses') }}" class="btn btn-primary btn-sm">Browse Courses</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-2">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-semibold">View Results</div>
                <div class="card-body">
                    <p class="text-muted">Check your academic results and grades.</p>
                    <a href="{{ route('student.view-results') }}" class="btn btn-primary btn-sm">View Results</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-semibold">Profile Settings</div>
                <div class="card-body">
                    <p class="text-muted">Update your personal information and profile.</p>
                    <a href="{{ route('student.profile') }}" class="btn btn-primary btn-sm">Manage Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection