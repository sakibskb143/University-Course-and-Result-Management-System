                    <div id="students" class="content-section">
                        <h4>Student Management</h4>

                        <!-- Button to open modal -->
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                            Add Student
                        </button>

                        <!-- Students Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Reg No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th>Year</th>
                                    <th>Department</th>
                                    <th>Semester</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2023-CSE-001</td>
                                    <td>Jane Doe</td>
                                    <td>jane@example.com</td>
                                    <td>0123456789</td>
                                    <td>2023</td>
                                    <td>Computer Science & Engineering</td>
                                    <td>1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Bootstrap Modal -->
                    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <form id="studentForm">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="student_reg_no" class="form-label">Registration No</label>
                                                <input type="text" class="form-control" id="student_reg_no"
                                                    name="student_reg_no" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="student_name" class="form-label">Student Name</label>
                                                <input type="text" class="form-control" id="student_name"
                                                    name="student_name" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    name="email">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="contact_no" class="form-label">Contact No</label>
                                                <input type="text" class="form-control" id="contact_no"
                                                    name="contact_no">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control" id="address" name="address"></textarea>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label for="year" class="form-label">Year</label>
                                                <input type="number" class="form-control" id="year" name="year"
                                                    min="2000" max="2099">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="department_id" class="form-label">Department</label>
                                                <select class="form-select" id="department_id" name="department_id"
                                                    required>
                                                    <option value="">-- Select Department --</option>
                                                    <option value="1">Computer Science & Engineering</option>
                                                    <option value="2">Electrical & Electronic Engineering</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label for="semester" class="form-label">Semester</label>
                                                <select class="form-select" id="semester" name="semester" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Student</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
