@extends('admin.layout')

@section('title', 'Edit Course')

@section('content')
    <div class="card p-4">
        <h4>Edit Course</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Department</label>
                <select name="department_id" class="form-select" required>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ old('department_id', $course->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->department_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Semester</label>
                <select name="semester_id" class="form-select" required>
                    <option value="">-- Select Semester --</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}"
                            {{ old('semester_id', $course->semester_id) == $semester->id ? 'selected' : '' }}>
                            {{ $semester->semester_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Course Code</label>
                <input type="text" name="course_code" class="form-control"
                    value="{{ old('course_code', $course->course_code) }}" required>
            </div>

            <div class="mb-3">
                <label>Course Name</label>
                <input type="text" name="course_name" class="form-control"
                    value="{{ old('course_name', $course->course_name) }}" required>
            </div>

            <div class="mb-3">
                <label>Credit</label>
                <input type="number" name="credit" step="0.1" min="0.5" max="5" class="form-control"
                    value="{{ old('credit', $course->credit) }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Course</button>
            </div>
        </form>
    </div>
@endsection
