<div id="classroom" class="content-section">
    <h4>Classroom Allocation</h4>

    <!-- Button to open modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addClassroomAllocationModal">
        Allocate Classroom
    </button>

    <!-- Classroom Allocation Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Department</th>
                <th>Course</th>
                <th>Room</th>
                <th>Day</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Computer Science & Engineering</td>
                <td>Database Systems</td>
                <td>Room 101</td>
                <td>Monday</td>
                <td>09:00 AM</td>
                <td>11:00 AM</td>
                <td>Active</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="addClassroomAllocationModal" tabindex="-1" aria-labelledby="addClassroomAllocationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addClassroomAllocationModalLabel">Allocate Classroom
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="classroomAllocationForm">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select" id="department_id" name="department_id" required>
                                <option value="">-- Select Department --</option>
                                <option value="1">Computer Science & Engineering</option>
                                <option value="2">Electrical & Electronic Engineering</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="course_id" class="form-label">Course</label>
                            <select class="form-select" id="course_id" name="course_id" required>
                                <option value="">-- Select Course --</option>
                                <option value="1">Database Systems</option>
                                <option value="2">Data Structures</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="room_id" class="form-label">Room</label>
                            <select class="form-select" id="room_id" name="room_id" required>
                                <option value="">-- Select Room --</option>
                                <option value="1">Room 101</option>
                                <option value="2">Room 202</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="day" class="form-label">Day</label>
                            <select class="form-select" id="day" name="day" required>
                                <option value="">-- Select Day --</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="time_from" class="form-label">Time From</label>
                            <input type="time" class="form-control" id="time_from" name="time_from" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="time_to" class="form-label">Time To</label>
                            <input type="time" class="form-control" id="time_to" name="time_to" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Allocate</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
