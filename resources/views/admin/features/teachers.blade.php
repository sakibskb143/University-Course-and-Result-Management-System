@extends('admin.layout')

@section('title', 'Teacher Management')

@section('content')
<div class="content-section">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Teacher Management</h4>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary">Add Teacher</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Department</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Designation</th>
                <th>Credit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->department->department_name }}</td>
                    <td>{{ $teacher->teacher_name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->contact_no }}</td>
                    <td>{{ $teacher->designation }}</td>
                    <td>{{ $teacher->credit_to_be_taken }}</td>
                    <td>
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No teachers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
