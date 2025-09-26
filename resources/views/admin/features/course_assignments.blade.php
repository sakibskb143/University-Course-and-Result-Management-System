@extends('admin.layout')

@section('title', 'Course Assignments')

@section('content')
<div class="content-section">
    <h4>Course Assignments</h4>

    <a href="{{ route('admin.course_assignments.create') }}" class="btn btn-primary mb-3">Assign Course</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Department</th>
                <th>Teacher</th>
                <th>Course</th>
                <th>Assigned Credit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignments as $assign)
            <tr>
                <td>{{ $assign->department->department_name }}</td>
                <td>{{ $assign->teacher->teacher_name }}</td>
                <td>{{ $assign->course->course_code }} - {{ $assign->course->course_name }}</td>
                <td>{{ $assign->assigned_credit }}</td>
                <td>
                    <a href="{{ route('admin.course_assignments.edit', $assign->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.course_assignments.destroy', $assign->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
