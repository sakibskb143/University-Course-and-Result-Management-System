<div id="course-assignment" class="content-section">
    <h4>Course Assignment to Teacher</h4>

    <!-- Button to open modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCourseAssignmentModal">
        Assign Course
    </button>

    <!-- Course Assignments Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Department</th>
                <th>Teacher</th>
                <th>Course</th>
                <th>Assigned Credit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Computer Science & Engineering</td>
                <td>John Doe</td>
                <td>CS101 - Introduction to Programming</td>
                <td>3.0</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="addCourseAssignmentModal" tabindex="-1" aria-labelledby="addCourseAssignmentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseAssignmentModalLabel">Assign Course to
                    Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body (Form) -->
            <div class="modal-body">
                <form id="courseAssignmentForm">
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select class="form-select" id="department_id" name="department_id" required>
                            <option value="">-- Select Department --</option>
                            <option value="1">Computer Science & Engineering</option>
                            <option value="2">Electrical & Electronic Engineering</option>
                            <option value="3">Mechanical Engineering</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="teacher_id" class="form-label">Teacher</label>
                        <select class="form-select" id="teacher_id" name="teacher_id" required>
                            <option value="">-- Select Teacher --</option>
                            <option value="1">John Doe</option>
                            <option value="2">Jane Smith</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <select class="form-select" id="course_id" name="course_id" required>
                            <option value="">-- Select Course --</option>
                            <option value="1">CS101 - Introduction to Programming</option>
                            <option value="2">CS102 - Data Structures</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="assigned_credit" class="form-label">Assigned Credit</label>
                        <input type="number" step="0.1" min="0.5" max="5.0" class="form-control"
                            id="assigned_credit" name="assigned_credit" required>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign Course</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
