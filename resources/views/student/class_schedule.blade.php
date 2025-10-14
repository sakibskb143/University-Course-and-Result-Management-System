@extends('student.layout')

@section('title', 'Class Schedule')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-semibold">
            <h5 class="mb-0">Class Schedule</h5>
        </div>
        <div class="card-body">
            @if(isset($currentSemester))
                <div class="alert alert-info">
                    <strong>Current Semester:</strong> {{ $currentSemester->name }}
                </div>
            @endif

            @if(empty($classSchedules))
                <div class="text-center py-5">
                    <i class="fa-solid fa-calendar-xmark fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Class Schedule Found</h5>
                    <p class="text-muted">You are not enrolled in any courses for the current semester.</p>
                    <a href="{{ route('student.enroll-courses') }}" class="btn btn-primary">Enroll in Courses</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Course</th>
                                <th>Teacher</th>
                                <th>Room</th>
                                <th>Day</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classSchedules as $schedule)
                                <tr>
                                    <td>
                                        <strong>{{ $schedule['course']->course_name }}</strong><br>
                                        <small class="text-muted">{{ $schedule['course']->course_code }}</small>
                                    </td>
                                    <td>
                                        @if($schedule['teacher'])
                                            {{ $schedule['teacher']->teacher_name }}
                                        @else
                                            <span class="text-muted">Not Assigned</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($schedule['room'])
                                            {{ $schedule['room']->room_name }}<br>
                                            <small class="text-muted">{{ $schedule['room']->room_number }}</small>
                                        @else
                                            <span class="text-muted">Not Allocated</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $schedule['day'] }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $schedule['start_time'] }}</strong> - 
                                        <strong>{{ $schedule['end_time'] }}</strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

