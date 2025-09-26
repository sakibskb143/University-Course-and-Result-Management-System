@extends('admin.layout')

@section('title', 'Course Management')

@section('content')
<div class="content-section">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Course Management</h4>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Add Course</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Department</th>
                <th>Semester</th>
                <th>Code</th>
                <th>Name</th>
                <th>Credit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $course->department->department_name }}</td>
                    <td>{{ $course->semester_id }}{{ $course->semester_id==1 ? 'st' : ($course->semester_id==2 ? 'nd' : ($course->semester_id==3 ? 'rd' : 'th')) }}</td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->credit }}</td>
                    <td>
                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No courses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
