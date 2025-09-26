<div class="row">
    <div class="mb-3 col-md-4">
        <label class="form-label">Department</label>
        <select class="form-select" name="department_id" required>
            <option value="">-- Select Department --</option>
            @foreach ($departments as $dept)
                <option value="{{ $dept->id }}"
                    {{ old('department_id', $allocation->department_id ?? '') == $dept->id ? 'selected' : '' }}>
                    {{ $dept->department_name }}
                </option>
            @endforeach
        </select>
        @error('department_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mb-3 col-md-4">
        <label class="form-label">Semester</label>
        <select class="form-select" name="semester_id" required>
            <option value="">-- Select Semester --</option>
            @foreach(\App\Models\Semester::all() as $sem)
                <option value="{{ $sem->id }}"
                    {{ old('semester_id', $allocation->semester_id ?? '') == $sem->id ? 'selected' : '' }}>
                    {{ $sem->semester_name }}
                </option>
            @endforeach
        </select>
        @error('semester_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>


    <div class="mb-3 col-md-4">
        <label class="form-label">Course</label>
        <select class="form-select" name="course_id" required>
            <option value="">-- Select Course --</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}"
                    {{ old('course_id', $allocation->course_id ?? '') == $course->id ? 'selected' : '' }}>
                    {{ $course->course_name }}
                </option>
            @endforeach
        </select>
        @error('course_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3 col-md-4">
        <label class="form-label">Room</label>
        <select class="form-select" name="room_id" required>
            <option value="">-- Select Room --</option>
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}"
                    {{ old('room_id', $allocation->room_id ?? '') == $room->id ? 'selected' : '' }}>
                    {{ $room->room_no }}
                </option>
            @endforeach
        </select>
        @error('room_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3 col-md-4">
        <label class="form-label">Day</label>
        <select class="form-select" name="day" required>
            <option value="">-- Select Day --</option>
            @foreach (['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'] as $day)
                <option value="{{ $day }}"
                    {{ old('day', $allocation->day ?? '') == $day ? 'selected' : '' }}>
                    {{ $day }}
                </option>
            @endforeach
        </select>
        @error('day')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3 col-md-4">
        <label class="form-label">Time From</label>
        <input type="time" name="time_from" class="form-control"
            value="{{ old('time_from', isset($allocation) ? date('H:i', strtotime($allocation->time_from)) : '') }}"
            required>
        @error('time_from')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3 col-md-4">
        <label class="form-label">Time To</label>
        <input type="time" name="time_to" class="form-control"
            value="{{ old('time_to', isset($allocation) ? date('H:i', strtotime($allocation->time_to)) : '') }}"
            required>
        @error('time_to')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3 col-md-4">
        <label class="form-label">Status</label>
        <select class="form-select" name="status">
            <option value="1" {{ old('status', $allocation->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $allocation->status ?? 1) == 0 ? 'selected' : '' }}>Inactive
            </option>
        </select>
        @error('status')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
