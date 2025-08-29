<div id="teachers" class="content-section">
                        <h4>Teacher Management</h4>

                        <!-- Button to open modal -->
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
                            Add Teacher
                        </button>

                        <!-- Teachers Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th>Designation</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody id="teachersTableBody">
                                <tr>
                                    <td>Computer Science & Engineering</td>
                                    <td>John Doe</td>
                                    <td>john@example.com</td>
                                    <td>0123456789</td>
                                    <td>Professor</td>
                                    <td>12.5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Bootstrap Modal -->
                    <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addTeacherModalLabel">Add Teacher</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <!-- Modal Body (Form) -->
                                <div class="modal-body">
                                    <form id="teacherForm">
                                        <div class="mb-3">
                                            <label for="department_id" class="form-label">Department</label>
                                            <select class="form-select" id="department_id" name="department_id"
                                                required>
                                                <option value="">-- Select Department --</option>
                                                <option value="1">Computer Science & Engineering</option>
                                                <option value="2">Electrical & Electronic Engineering</option>
                                                <option value="3">Mechanical Engineering</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="teacher_name" class="form-label">Teacher Name</label>
                                            <input type="text" class="form-control" id="teacher_name"
                                                name="teacher_name" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>

                                        <div class="mb-3">
                                            <label for="contact_no" class="form-label">Contact No</label>
                                            <input type="text" class="form-control" id="contact_no"
                                                name="contact_no">
                                        </div>

                                        <div class="mb-3">
                                            <label for="designation" class="form-label">Designation</label>
                                            <input type="text" class="form-control" id="designation"
                                                name="designation">
                                        </div>

                                        <div class="mb-3">
                                            <label for="credit_to_be_taken" class="form-label">Credit to be
                                                Taken</label>
                                            <input type="number" step="0.1" min="0" class="form-control"
                                                id="credit_to_be_taken" name="credit_to_be_taken">
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Teacher</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>