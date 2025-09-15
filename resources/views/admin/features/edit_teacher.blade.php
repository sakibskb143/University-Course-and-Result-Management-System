@extends('admin.layout')

@section('title', 'Edit Teacher')

@section('content')
<div class="content-section">
    <h4>Edit Teacher</h4>

    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Department -->
        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-select" required>
                <option value="">-- Select Department --</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', $teacher->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->department_name }}
                    </option>
                @endforeach
            </select>
            @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Teacher Name -->
        <div class="mb-3">
            <label class="form-label">Teacher Name</label>
            <input type="text" name="teacher_name" class="form-control" value="{{ old('teacher_name', $teacher->teacher_name) }}" required>
            @error('teacher_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->email) }}">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Contact Number -->
        <div class="mb-3">
            <label class="form-label">Contact No</label>
            <input type="text" name="contact_no" class="form-control" maxlength="11" 
                   value="{{ old('contact_no', $teacher->contact_no) }}">
            @error('contact_no') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Designation -->
        <div class="mb-3">
            <label class="form-label">Designation</label>
            <input type="text" name="designation" class="form-control" value="{{ old('designation', $teacher->designation) }}">
            @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Credit to be Taken -->
        <div class="mb-3">
            <label class="form-label">Credit to be Taken</label>
            <input 
                type="text" 
                name="credit_to_be_taken" 
                class="form-control" 
                value="{{ old('credit_to_be_taken', $teacher->credit_to_be_taken) }}"
                pattern="^\d+(\.\d{1,2})?$"
                title="Enter a number greater than or equal to 20, with up to 2 decimal places"
            >
            @error('credit_to_be_taken') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
