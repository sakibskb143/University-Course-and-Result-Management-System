<div class="row">
    <div class="mb-3 col-md-6">
        <label for="student_reg_no" class="form-label">Registration No</label>
        <input type="text" class="form-control" id="student_reg_no" name="student_reg_no"
            value="{{ old('student_reg_no', $student->student_reg_no ?? '') }}" required>
        @error('student_reg_no') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="student_name" class="form-label">Student Name</label>
        <input type="text" class="form-control" id="student_name" name="student_name"
            value="{{ old('student_name', $student->student_name ?? '') }}" required>
        @error('student_name') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email"
            value="{{ old('email', $student->email ?? '') }}">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="contact_no" class="form-label">Contact No</label>
        <input type="text" class="form-control" id="contact_no" name="contact_no"
            value="{{ old('contact_no', $student->contact_no ?? '') }}">
        @error('contact_no') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address">{{ old('address', $student->address ?? '') }}</textarea>
        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3 col-md-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" class="form-control" id="year" name="year"
            value="{{ old('year', $student->year ?? '') }}" min="2000" max="2099">
        @error('year') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3 col-md-4">
        <label for="department_id" class="form-label">Department</label>
        <select class="form-select" id="department_id" name="department_id" required>
            <option value="">-- Select Department --</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}"
                    {{ old('department_id', $student->department_id ?? '') == $department->id ? 'selected' : '' }}>
                    {{ $department->department_name }}
                </option>
            @endforeach
        </select>
        @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3 col-md-3">
        <label for="semester" class="form-label">Semester</label>
        <select class="form-select" id="semester" name="semester" required>
            @for($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}" {{ old('semester', $student->semester ?? '') == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>
        @error('semester') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>
