@extends('admin.layout')

@section('title', 'Assign Course')

@section('content')
<div class="content-section">
    <h4>Assign Course to Teacher</h4>

    <form action="{{ route('admin.course_assignments.store') }}" method="POST">
        @csrf

        <!-- Department -->
        <div class="mb-3">
            <label for="department_id" class="form-label">Department</label>
            <select id="department_id" name="department_id" class="form-select" required>
                <option value="">-- Select Department --</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->department_name }}
                    </option>
                @endforeach
            </select>
            @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Teacher -->
        <div class="mb-3">
            <label for="teacher_id" class="form-label">Teacher</label>
            <select id="teacher_id" name="teacher_id" class="form-select" required>
                <option value="">-- Select Teacher --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" data-department="{{ $teacher->department_id }}" 
                        {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->teacher_name }}
                    </option>
                @endforeach
            </select>
            @error('teacher_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Course -->
        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select id="course_id" name="course_id" class="form-select" required>
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" data-credit="{{ $course->credit }}">
                        {{ $course->course_code }} - {{ $course->course_name }}
                    </option>
                @endforeach
            </select>
            @error('course_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Assigned Credit -->
        <div class="mb-3">
            <label for="assigned_credit" class="form-label">Assigned Credit</label>
            <input type="number" name="assigned_credit" id="assigned_credit" step="0.1" min="0" class="form-control" 
                value="{{ old('assigned_credit') }}" readonly required>
            @error('assigned_credit') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-success">Assign Course</button>
        <a href="{{ route('admin.course_assignments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    const departmentSelect = document.getElementById('department_id');
    const teacherSelect = document.getElementById('teacher_id');
    const courseSelect = document.getElementById('course_id');
    const creditInput = document.getElementById('assigned_credit');

    // Filter teachers by department
    departmentSelect.addEventListener('change', function() {
        const departmentId = this.value;

        Array.from(teacherSelect.options).forEach(option => {
            if(option.value === '') return; // default option
            option.style.display = option.dataset.department === departmentId ? 'block' : 'none';
        });

        teacherSelect.value = '';
    });

    // Auto-fill assigned credit when course is selected
    courseSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const credit = selectedOption.dataset.credit || '';
        creditInput.value = credit;
    });

    // Trigger change to restore old values if validation fails
    window.addEventListener('load', () => {
        if(departmentSelect.value) {
            departmentSelect.dispatchEvent(new Event('change'));
        }
        if(courseSelect.value) {
            courseSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection
