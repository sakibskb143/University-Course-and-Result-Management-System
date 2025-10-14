@extends('teacher.layout')

@section('title', 'Class Schedule')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Class Schedule</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="primary-color"><i class="fa-solid fa-calendar me-2"></i>Class Schedule</h3>
        <span class="badge bg-primary fs-6">{{ $schedules->count() }} Classes</span>
    </div>

    <!-- Schedule Table -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fa-solid fa-table me-2"></i>Your Class Schedule</h5>
        </div>
        <div class="card-body p-0">
            @if($schedules->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Course</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Room</th>
                                <th>Semester</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                            <tr>
                                <td>
                                    <div>
                                        <span class="fw-bold">{{ $schedule->course->course_name ?? 'N/A' }}</span>
                                        <br>
                                        <small class="text-muted">{{ $schedule->course->course_code ?? 'N/A' }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $schedule->day ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold">
                                        {{ $schedule->time_from ?? 'N/A' }} - {{ $schedule->time_to ?? 'N/A' }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <i class="fa-solid fa-door-open me-1"></i>
                                        {{ $schedule->room->room_no ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    @if($schedule->semester)
                                        <span class="badge bg-success">{{ $schedule->semester->semester_name ?? 'N/A' }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($schedule->status == 'Active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($schedule->status == 'Inactive')
                                        <span class="badge bg-danger">Inactive</span>
                                    @else
                                        <span class="badge bg-warning">{{ $schedule->status ?? 'Unknown' }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa-solid fa-calendar text-muted" style="font-size: 64px;"></i>
                    <h5 class="text-muted mt-3">No Schedule Found</h5>
                    <p class="text-muted">You don't have any class schedule assigned yet. Contact the administrator for classroom allocation.</p>
                    <a href="{{ route('teacher.dashboard') }}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Schedule Summary -->
    @if($schedules->count() > 0)
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fa-solid fa-clock me-2"></i>Weekly Schedule</h6>
                </div>
                <div class="card-body">
                    @php
                        $weeklySchedule = $schedules->groupBy('day');
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    @endphp
                    
                    @foreach($days as $day)
                        @if($weeklySchedule->has($day))
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold">{{ $day }}</span>
                                <span class="badge bg-primary">{{ $weeklySchedule[$day]->count() }} classes</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0"><i class="fa-solid fa-chart-bar me-2"></i>Schedule Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="text-primary">{{ $schedules->count() }}</h5>
                            <small class="text-muted">Total Classes</small>
                        </div>
                        <div class="col-4">
                            <h5 class="text-success">{{ $schedules->where('status', 'Active')->count() }}</h5>
                            <small class="text-muted">Active</small>
                        </div>
                        <div class="col-4">
                            <h5 class="text-info">{{ $schedules->groupBy('room_id')->count() }}</h5>
                            <small class="text-muted">Rooms</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
