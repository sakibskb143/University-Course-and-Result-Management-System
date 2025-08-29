<!doctype html>
<html lang="en">

<head>
    <title>Teacher Dashboard - University CMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0cd1eac34e.js" crossorigin="anonymous"></script>

    <style>
        :root {
            --primary-color: rgba(18, 88, 117, 0.9);
            --accent-color: rgb(255, 115, 80);
        }
        body { font-family: "Open Sans", sans-serif; }
        .sidebar {
            min-height: 100vh;
            background: #E5E5E5;
            color: var(--primary-color);
        }
        .sidebar .nav-link {
            color: var(--primary-color);
            font-weight: 500;
            padding: 10px 15px;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--primary-color);
            border-radius: 5px;
            color: white;
        }
        .content-section { display: none; }
        .content-section.active { display: block; }
        .fa-graduation-cap {
            color: var(--accent-color);
            font-size: 32px;
        }
        .brand-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--accent-color);
        }
        .brand-title span { color: var(--primary-color); }
        .brand-title .highlight { color: var(--accent-color); }
        .top-bar {
            background: white;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .admin-info { display: flex; align-items: center; gap: 10px; }
        .admin-info i { font-size: 30px; color: var(--primary-color); }
        .admin-details small { display: block; font-size: 12px; color: gray; }
        .primary-color { color: var(--primary-color); }
        .bg-clr-1 { background-color: var(--primary-color); }
        .bg-clr-2 { background-color: #84AE92; }
        .bg-clr-3 { background-color: #987070; }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <div class="mb-4">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <i class="fa-solid fa-graduation-cap me-2"></i>
                    <span class="brand-title">
                        <span>P</span><span class="highlight">UC</span>
                    </span>
                </a>
            </div>
            <ul class="nav flex-column gap-1">
                <li class="nav-item"><a href="#" class="nav-link active" data-target="dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-target="courses"><i class="fa-solid fa-book-open"></i> Assigned Courses</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-target="schedule"><i class="fa-solid fa-calendar"></i> Class Schedule</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-target="save-result"><i class="fa-solid fa-pen-to-square"></i> Save Student Result</a></li>
                <li class="mt-4 border-top pt-2 nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-0">
            <!-- Top Bar -->
            <div class="top-bar">
                <h5 class="m-3 fs-2 uppercase primary-color fw-bold">Teacher Dashboard</h5>
                <div class="admin-info">
                    <i class="fa-solid fa-user-circle"></i>
                    <div class="admin-details primary-color">
                        <strong>John Teacher</strong>
                        <small>teacher@university.com</small>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <!-- Dashboard Overview -->
                <div id="dashboard" class="content-section active">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card shadow-sm p-3 bg-clr-1 text-white">
                                <h5>Assigned Courses</h5>
                                <h2>3</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm p-3 bg-clr-2 text-white">
                                <h5>Classes This Week</h5>
                                <h2>12</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm p-3 bg-clr-3 text-white">
                                <h5>Results Saved</h5>
                                <h2>45</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Assigned Courses -->
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

                <!-- View Class Schedule -->
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

            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Sidebar Navigation
    document.querySelectorAll('.sidebar .nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.sidebar .nav-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            document.querySelectorAll('.content-section').forEach(sec => sec.classList.remove('active'));
            const target = this.getAttribute('data-target');
            if (target) {
                document.getElementById(target).classList.add('active');
            }
        });
    });

    // Auto-generate grade
    function generateGrade(marks) {
        let grade = "";
        marks = parseInt(marks);
        if (marks >= 90) grade = "A+";
        else if (marks >= 80) grade = "A";
        else if (marks >= 70) grade = "B";
        else if (marks >= 60) grade = "C";
        else if (marks >= 50) grade = "D";
        else grade = "F";
        document.getElementById('grade').value = grade;
    }
</script>

</body>
</html>
