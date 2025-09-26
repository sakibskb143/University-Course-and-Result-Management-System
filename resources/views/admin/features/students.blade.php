@extends('admin.layout')

@section('title', 'Students')

@section('content')
<div id="students" class="content-section">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><i class="fa-solid fa-user-graduate"></i> Student Management</h4>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add Student
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Reg No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Year</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $student->student_reg_no }}</td>
                            <td>{{ $student->student_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->contact_no }}</td>
                            <td>{{ $student->year }}</td>
                            <td>{{ $student->department->department_name }}</td>
                            <td>{{ $student->semester }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted py-3">No students found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $students->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
