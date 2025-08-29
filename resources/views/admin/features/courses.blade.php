<div id="courses" class="content-section">
    <h4>Course Management</h4>

    <!-- Add Course Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="collapse" data-bs-target="#addCourseForm">
        Add Course
    </button>

    <!-- Collapsible Add Course Form -->
    <div id="addCourseForm" class="collapse">
        <form>
            <div class="mb-3">
                <label for="department_id" class="form-label">Department</label>
                <select class="form-select" id="department_id" name="department_id" required>
                    <option value="">-- Select Department --</option>
                    <option value="1">Computer Science & Engineering</option>
                    <option value="2">Electrical & Electronic Engineering</option>
                    <option value="3">Business Administration</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="semester_id" class="form-label">Semester</label>
                <select class="form-select" id="semester_id" name="semester_id" required>
                    <option value="">-- Select Semester --</option>
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
                    <option value="1">5st</option>
                    <option value="2">6nd</option>
                    <option value="3">7rd</option>
                    <option value="4">8th</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="course_code" class="form-label">Course Code</label>
                <input type="text" class="form-control" id="course_code" name="course_code" required>
            </div>

            <div class="mb-3">
                <label for="course_name" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="course_name" name="course_name" required>
            </div>

            <div class="mb-3">
                <label for="credit" class="form-label">Credit</label>
                <input type="number" step="0.1" min="0.5" max="5.0" class="form-control" id="credit"
                    name="credit" required>
            </div>

            <button type="button" class="btn btn-primary">Add Course</button>
        </form>
    </div>

    <!-- Static Courses List -->
    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Department</th>
                <th>Semester</th>
                <th>Code</th>
                <th>Name</th>
                <th>Credit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Computer Science & Engineering</td>
                <td>1st</td>
                <td>CSE101</td>
                <td>Introduction to Programming</td>
                <td>3.0</td>
            </tr>
            <tr>
                <td>Electrical & Electronic Engineering</td>
                <td>2nd</td>
                <td>EEE201</td>
                <td>Circuits & Systems</td>
                <td>3.5</td>
            </tr>
            <tr>
                <td>Business Administration</td>
                <td>3rd</td>
                <td>BBA301</td>
                <td>Principles of Management</td>
                <td>2.5</td>
            </tr>
        </tbody>
    </table>
</div>
