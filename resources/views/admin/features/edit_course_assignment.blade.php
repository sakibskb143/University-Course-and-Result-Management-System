@extends('admin.layout')

@section('title', 'Edit Course Assignment')

@section('content')
<div class="content-section">
    <h4>Edit Course Assignment</h4>

    <form action="{{ route('admin.course_assignments.update', $courseAssignment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Department -->
        <div class="mb-3">
            <label for="department_id" class="form-label">Department</label>
            <select id="department_id" name="department_id" class="form-select" required>
                <option value="">-- Select Department --</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" 
                        {{ old('department_id', $courseAssignment->department_id) == $department->id ? 'selected' : '' }}>
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
                    <option value="{{ $teacher->id }}" 
                        data-department="{{ $teacher->department_id }}"
                        {{ old('teacher_id', $courseAssignment->teacher_id) == $teacher->id ? 'selected' : '' }}>
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
                    <option value="{{ $course->id }}" 
                        data-credit="{{ $course->credit }}"
                        {{ old('course_id', $courseAssignment->course_id) == $course->id ? 'selected' : '' }}>
                        {{ $course->course_code }} - {{ $course->course_name }}
                    </option>
                @endforeach
            </select>
            @error('course_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Assigned Credit -->
        <div class="mb-3">
            <label for="assigned_credit" class="form-label">Assigned Credit</label>
            <input type="number" id="assigned_credit" name="assigned_credit" step="0.1" min="0.5" max="5.0" 
                class="form-control" 
                value="{{ old('assigned_credit', $courseAssignment->assigned_credit) }}" required>
            @error('assigned_credit') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Buttons -->
        <button type="submit" class="btn btn-success">Update Assignment</button>
        <a href="{{ route('admin.course_assignments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    const departmentSelect = document.getElementById('department_id');
    const teacherSelect = document.getElementById('teacher_id');
    const courseSelect = document.getElementById('course_id');
    const assignedCreditInput = document.getElementById('assigned_credit');

    // Filter teachers by department
    departmentSelect.addEventListener('change', function() {
        const departmentId = this.value;
        Array.from(teacherSelect.options).forEach(option => {
            if(option.value === '') return;
            option.style.display = option.dataset.department == departmentId ? 'block' : 'none';
        });
        teacherSelect.value = '';
    });

    // Auto-fill assigned credit when course changes
    courseSelect.addEventListener('change', function() {
        const selectedOption = this.selectedOptions[0];
        if(selectedOption && selectedOption.dataset.credit) {
            assignedCreditInput.value = selectedOption.dataset.credit;
        }
    });

    // Trigger on page load for existing values
    window.addEventListener('load', function() {
        const event = new Event('change');
        departmentSelect.dispatchEvent(event);
        courseSelect.dispatchEvent(event);
    });
</script>
@endsection
