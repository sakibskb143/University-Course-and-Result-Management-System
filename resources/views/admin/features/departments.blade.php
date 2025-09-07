@extends('admin.layout')

@section('title', 'Departments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Departments</h4>

    <!-- Link to Create Department Page -->
    <a href="{{ route('departments.create') }}" class="btn btn-primary">
        Add Department
    </a>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Departments Table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($departments as $dept)
        <tr>
            <td>{{ $dept->id }}</td>
            <td>{{ $dept->department_code }}</td>
            <td>{{ $dept->department_name }}</td>
            <td>{{ $dept->created_at->format('d M Y') }}</td>
            <td>{{ $dept->updated_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('departments.edit', $dept->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">No departments found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
