@extends('layouts.teacher')

@section('title', 'Teacher Dashboard')

@section('content')
    <!-- Dashboard Overview -->
<div id="dashboard" class="content-section active">

    <!-- Search & Filter Bar -->
    <div class="card shadow-sm p-3 mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Select Semester</option>
                    <option value="1">1st Semester</option>
                    <option value="2">2nd Semester</option>
                    <option value="3">3rd Semester</option>
                    <option value="4">4th Semester</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Select Department</option>
                    <option value="CSE">Computer Science</option>
                    <option value="EEE">Electrical Engineering</option>
                    <option value="BBA">Business Administration</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Search by CourseName">
            </div>
            <div class="col-md-3 text-end">
                <button class="btn btn-primary w-100">
                    <i class="fa-solid fa-magnifying-glass"></i> Search
                </button>
            </div>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 bg-clr-1 text-white">
                <h5>Assigned Courses</h5>
                <h2>3</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 bg-clr-2 text-white">
                <h5>Classes This Week</h5>
                <h2>12</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 bg-clr-3 text-white">
                <h5>Results Saved</h5>
                <h2>45</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 bg-dark text-white">
                <h5>Total Students</h5>
                <h2>120</h2>
            </div>
        </div>
    </div>
</div>

    <!-- Assigned Courses -->
    <div id="courses" class="content-section">
        <h4>Assigned Courses</h4>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Course Code</th>
                    <th>Name</th>
                    <th>Credit</th>
                    <th>Semester</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CSE101</td>
                    <td>Introduction to Programming</td>
                    <td>3</td>
                    <td>1st</td>
                    <td>Computer Science</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Class Schedule -->
    <div id="schedule" class="content-section">
        <h4>Class Schedule</h4>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Course</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Room</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Introduction to Programming</td>
                    <td>Saturday</td>
                    <td>9:00 AM - 10:30 AM</td>
                    <td>Room 101</td>
                </tr>
                <tr>
                    <td>Database Management System</td>
                    <td>Sunday</td>
                    <td>9:00 AM - 10:30 AM</td>
                    <td>Room 101</td>
                </tr>
                <tr>
                    <td>Introduction to Programming</td>
                    <td>Monday</td>
                    <td>9:00 AM - 10:30 AM</td>
                    <td>Room 101</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Save Student Result -->
    <div id="save-result" class="content-section">
        <h4>Save Student Result</h4>
        <form>
            <div class="mb-3">
                <label class="form-label">Student Roll</label>
                <input type="text" class="form-control" placeholder="Enter Student Roll">
            </div>
            <div class="mb-3">
                <label class="form-label">Student Name</label>
                <input type="text" class="form-control" placeholder="Enter Student Name">
            </div>
            <div class="mb-3">
                <label class="form-label">Course</label>
                <select class="form-select">
                    <option>Select Course</option>
                    <option value="1">Introduction to Programming</option>
                    <option value="2">Database Systems</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Marks</label>
                <input type="number" class="form-control" placeholder="Enter Marks" min="0" max="100" oninput="generateGrade(this.value)">
            </div>
            <div class="mb-3">
                <label class="form-label">Grade</label>
                <input type="text" class="form-control" id="grade" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Save Result</button>
        </form>
    </div>
@endsection
