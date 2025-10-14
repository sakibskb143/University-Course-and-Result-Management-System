@extends('student.layout')

@section('title', 'Enroll in Courses')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-semibold">
            <h5 class="mb-0">Available Courses for Enrollment</h5>
        </div>
        <div class="card-body">
            @if(isset($currentSemester))
                <div class="alert alert-info">
                    <strong>Current Semester:</strong> {{ $currentSemester->name }}
                </div>
            @endif

            @if($availableCourses->isEmpty())
                <div class="text-center py-5">
                    <i class="fa-solid fa-book fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Courses Available</h5>
                    <p class="text-muted">There are no courses available for enrollment in your department for the current semester.</p>
                    <a href="{{ route('student.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
                </div>
            @else
                <div class="row g-3">
                    @foreach($availableCourses as $course)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">{{ $course->course_name }}</h6>
                                    <p class="card-text">
                                        <strong>Code:</strong> {{ $course->course_code }}<br>
                                        <strong>Department:</strong> {{ $course->department->name }}<br>
                                        <strong>Teacher:</strong> 
                                        @if($course->teacher)
                                            {{ $course->teacher->teacher_name }}
                                        @else
                                            <span class="text-muted">Not Assigned</span>
                                        @endif
                                        <br>
                                        <strong>Credit Hours:</strong> {{ $course->credit_hours ?? 'N/A' }}<br>
                                        @if($course->course_fee)
                                            <strong>Fee:</strong> ${{ number_format($course->course_fee, 2) }}
                                        @endif
                                    </p>
                                    
                                    @if($course->description)
                                        <p class="card-text">
                                            <small class="text-muted">{{ Str::limit($course->description, 100) }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent">
                                    @if(in_array($course->id, $enrolledCourseIds))
                                        <button class="btn btn-success btn-sm w-100" disabled>
                                            <i class="fa-solid fa-check"></i> Already Enrolled
                                        </button>
                                    @else
                                        <form action="{{ route('student.enroll-course') }}" method="POST" class="d-inline w-100">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                                <i class="fa-solid fa-plus"></i> Enroll Now
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

