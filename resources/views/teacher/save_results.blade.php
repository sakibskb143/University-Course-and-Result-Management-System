@extends('teacher.layout')

@section('title', 'Save Student Results')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Save Student Results</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="primary-color"><i class="fa-solid fa-pen-to-square me-2"></i>Save Student Results</h3>
    </div>

    <!-- Course and Semester Selection -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fa-solid fa-filter me-2"></i>Select Course and Semester</h5>
        </div>
        <div class="card-body">
            <form id="course-selection-form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="semester_id" class="form-label">Semester</label>
                        <select class="form-select" id="semester_id" name="semester_id" required>
                            <option value="">Select Semester</option>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="course_id" class="form-label">Course</label>
                        <select class="form-select" id="course_id" name="course_id" required disabled>
                            <option value="">Select Course</option>
                            @foreach($assignedCourses as $assignment)
                                <option value="{{ $assignment->course->id }}" data-course-code="{{ $assignment->course->course_code }}">
                                    {{ $assignment->course->course_code }} - {{ $assignment->course->course_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" id="load-students-btn" disabled>
                        <i class="fa-solid fa-search me-1"></i> Load Students
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Students Results Form -->
    <div id="students-section" class="card" style="display: none;">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fa-solid fa-users me-2"></i>Student Results</h5>
        </div>
        <div class="card-body">
            <form id="results-form" method="POST" action="{{ route('teacher.save-student-results') }}">
                @csrf
                <input type="hidden" id="form_course_id" name="course_id">
                <input type="hidden" id="form_semester_id" name="semester_id">
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Department</th>
                                <th>Marks</th>
                                <th>Grade</th>
                                <th>Grade Point</th>
                            </tr>
                        </thead>
                        <tbody id="students-tbody">
                            <!-- Students will be loaded here -->
                        </tbody>
                    </table>
                </div>
                
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg" id="save-results-btn">
                        <i class="fa-solid fa-save me-2"></i>Save Results
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Instructions -->
    <div class="card mt-4">
        <div class="card-header bg-info text-white">
            <h6 class="mb-0"><i class="fa-solid fa-info-circle me-2"></i>Instructions</h6>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                <li><i class="fa-solid fa-check text-success me-2"></i>Select semester and course to load enrolled students</li>
                <li><i class="fa-solid fa-check text-success me-2"></i>Enter marks (0-100) for each student</li>
                <li><i class="fa-solid fa-check text-success me-2"></i>Grades and grade points will be calculated automatically</li>
                <li><i class="fa-solid fa-check text-success me-2"></i>Click "Save Results" to submit all results</li>
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const semesterSelect = document.getElementById('semester_id');
    const courseSelect = document.getElementById('course_id');
    const loadStudentsBtn = document.getElementById('load-students-btn');
    const studentsSection = document.getElementById('students-section');
    const studentsTbody = document.getElementById('students-tbody');
    const resultsForm = document.getElementById('results-form');
    const formCourseId = document.getElementById('form_course_id');
    const formSemesterId = document.getElementById('form_semester_id');

    // Enable course selection when semester is selected
    semesterSelect.addEventListener('change', function() {
        if (this.value) {
            courseSelect.disabled = false;
            loadStudentsBtn.disabled = false;
        } else {
            courseSelect.disabled = true;
            loadStudentsBtn.disabled = true;
            studentsSection.style.display = 'none';
        }
    });

    // Load students when button is clicked
    loadStudentsBtn.addEventListener('click', function() {
        const semesterId = semesterSelect.value;
        const courseId = courseSelect.value;
        
        if (!semesterId || !courseId) {
            alert('Please select both semester and course');
            return;
        }

        // Show loading state
        this.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i>Loading...';
        this.disabled = true;

        // Make AJAX request to get students
        fetch('{{ route("teacher.get-course-students") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                semester_id: semesterId,
                course_id: courseId
            })
        })
        .then(response => response.json())
        .then(data => {
            displayStudents(data.enrollments, data.results);
            formCourseId.value = courseId;
            formSemesterId.value = semesterId;
            studentsSection.style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading students. Please try again.');
        })
        .finally(() => {
            this.innerHTML = '<i class="fa-solid fa-search me-1"></i> Load Students';
            this.disabled = false;
        });
    });

    function displayStudents(enrollments, results) {
        studentsTbody.innerHTML = '';
        
        if (enrollments.length === 0) {
            studentsTbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="fa-solid fa-users fa-2x mb-2 d-block"></i>
                        No students enrolled in this course for the selected semester
                    </td>
                </tr>
            `;
            return;
        }

        enrollments.forEach(enrollment => {
            const student = enrollment.student;
            const existingResult = results[student.id] || {};
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <input type="hidden" name="results[${student.id}][student_id]" value="${student.id}">
                    <span class="badge bg-secondary">${student.student_reg_no || 'N/A'}</span>
                </td>
                <td class="fw-bold">${student.student_name || 'N/A'}</td>
                <td>${student.department ? student.department.department_name : 'N/A'}</td>
                <td>
                    <input type="number" 
                           class="form-control marks-input" 
                           name="results[${student.id}][marks]" 
                           value="${existingResult.marks || ''}"
                           min="0" 
                           max="100" 
                           step="0.01"
                           required
                           oninput="calculateGrade(this)">
                </td>
                <td>
                    <span class="badge bg-info grade-display">${existingResult.letter_grade || ''}</span>
                </td>
                <td>
                    <span class="badge bg-success grade-point-display">${existingResult.grade_point || ''}</span>
                </td>
            `;
            studentsTbody.appendChild(row);
        });
    }

    // Calculate grade and grade point
    window.calculateGrade = function(input) {
        const marks = parseFloat(input.value) || 0;
        const row = input.closest('tr');
        const gradeDisplay = row.querySelector('.grade-display');
        const gradePointDisplay = row.querySelector('.grade-point-display');
        
        let grade = '';
        let gradePoint = 0;
        
        if (marks >= 90) { grade = 'A+'; gradePoint = 4.00; }
        else if (marks >= 80) { grade = 'A'; gradePoint = 3.75; }
        else if (marks >= 70) { grade = 'B'; gradePoint = 3.50; }
        else if (marks >= 60) { grade = 'C'; gradePoint = 3.25; }
        else if (marks >= 50) { grade = 'D'; gradePoint = 3.00; }
        else { grade = 'F'; gradePoint = 0.00; }
        
        gradeDisplay.textContent = grade;
        gradeDisplay.className = grade === 'F' ? 'badge bg-danger grade-display' : 'badge bg-info grade-display';
        
        gradePointDisplay.textContent = gradePoint.toFixed(2);
        gradePointDisplay.className = grade === 'F' ? 'badge bg-danger grade-point-display' : 'badge bg-success grade-point-display';
    };

    // Form submission validation
    resultsForm.addEventListener('submit', function(e) {
        const marksInputs = document.querySelectorAll('.marks-input');
        let hasInvalidMarks = false;
        
        marksInputs.forEach(input => {
            const marks = parseFloat(input.value);
            if (isNaN(marks) || marks < 0 || marks > 100) {
                hasInvalidMarks = true;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });
        
        if (hasInvalidMarks) {
            e.preventDefault();
            alert('Please enter valid marks (0-100) for all students.');
        }
    });
});
</script>
@endpush
