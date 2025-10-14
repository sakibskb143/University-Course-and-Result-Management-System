@extends('teacher.layout')

@section('title', 'Assigned Classes')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Assigned Classes</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="primary-color"><i class="fa-solid fa-chalkboard-teacher me-2"></i>Assigned Classes</h3>
        <span class="badge bg-primary fs-6">{{ $assignments->count() }} Classes</span>
    </div>

    <!-- Classes Table -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fa-solid fa-list me-2"></i>Your Assigned Classes</h5>
        </div>
        <div class="card-body p-0">
            @if($assignments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Department</th>
                                <th>Semester</th>
                                <th>Credit</th>
                                <th>Assigned Credit</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignments as $assignment)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary">{{ $assignment->course->course_code ?? 'N/A' }}</span>
                                </td>
                                <td class="fw-bold">{{ $assignment->course->course_name ?? 'N/A' }}</td>
                                <td>{{ $assignment->department->department_name ?? 'N/A' }}</td>
                                <td>
                                    @if($assignment->course->semester)
                                        <span class="badge bg-info">{{ $assignment->course->semester->semester_name ?? 'N/A' }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ $assignment->course->credit ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $assignment->assigned_credit ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('teacher.save-results') }}" class="btn btn-outline-primary" title="Save Results">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('teacher.class-schedule') }}" class="btn btn-outline-info" title="View Schedule">
                                            <i class="fa-solid fa-calendar"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa-solid fa-chalkboard-teacher text-muted" style="font-size: 64px;"></i>
                    <h5 class="text-muted mt-3">No Classes Assigned</h5>
                    <p class="text-muted">You don't have any assigned classes yet. Contact the administrator to get courses assigned.</p>
                    <a href="{{ route('teacher.dashboard') }}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Summary Cards -->
    @if($assignments->count() > 0)
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <i class="fa-solid fa-book fa-2x mb-2"></i>
                    <h4>{{ $assignments->count() }}</h4>
                    <p class="mb-0">Total Assigned Courses</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <i class="fa-solid fa-graduation-cap fa-2x mb-2"></i>
                    <h4>{{ $assignments->sum('assigned_credit') }}</h4>
                    <p class="mb-0">Total Assigned Credits</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <i class="fa-solid fa-building fa-2x mb-2"></i>
                    <h4>{{ $assignments->groupBy('department_id')->count() }}</h4>
                    <p class="mb-0">Departments</p>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
