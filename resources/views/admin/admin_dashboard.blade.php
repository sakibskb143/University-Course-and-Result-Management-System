<!doctype html>
<html lang="en">

<head>
    <title>Admin Dashboard - University CMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0cd1eac34e.js" crossorigin="anonymous"></script>

    <style>
        :root {
            --primary-color: rgba(18, 88, 117, 0.9);
            --accent-color: rgb(255, 115, 80);
        }

        body {
            font-family: "Open Sans", sans-serif;
        }

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

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .fa-graduation-cap {
            color: var(--accent-color);
            font-size: 32px;
        }

        .brand-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--accent-color);
            margin: 0;
        }

        .brand-title span {
            color: var(--primary-color);
        }

        .brand-title .highlight {
            color: var(--accent-color);
        }

        /* Top bar styles */
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

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-info i {
            font-size: 30px;
            color: var(--primary-color);
        }

        .admin-details small {
            display: block;
            font-size: 12px;
            color: gray;
        }

        .primary-color {
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px;
        }

        .btn-primary:hover {
            background-color: var(--accent-color);
        }

        .btn-secondary {
            background-color: var(--accent-color);
            border: none;
            padding: 10px;
        }

        .btn-secondary:hover {
            background-color: var(--primary-color)
        }

        .bg-clr-1 {
            background-color:var(--primary-color);

        }

        .bg-clr-2 {
            background-color: #84AE92;
        }
        .bg-clr-3{
            background-color: #987070;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('admin.sidebar')

            <!-- Main Content -->
            <div class="col-md-10 p-0">

                <!-- Top bar are starts  -->
                @include('admin.topbar')
                <!-- Top bar are ends-->


                <div class="p-4">
                    <!-- Dashboard Overview -->
                    <div id="dashboard" class="content-section active">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card shadow-sm p-3 bg-clr-1 text-white">
                                    <h5>Total Departments</h5>
                                    <h2>12</h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm p-3 bg-clr-2 text-white">
                                    <h5>Total Courses</h5>
                                    <h2>85</h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm p-3 bg-clr-3 text-white">
                                    <h5>Total Students</h5>
                                    <h2>1200</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Department Management are starts-->
                    @include('admin.features.departments')
                    <!-- Department Management are ends-->

                    {{-- courses section are starts --}}
                    @include('admin.features.courses')
                    {{-- courses section are ends --}}

                    {{-- teachers section are starts --}}
                    @include('admin.features.teachers')
                    {{-- teachers section are ends --}}

                    {{-- course-assignment are starts --}}


                    {{-- course-assignment are ends --}}
                    @include('admin/features/course_assignment')
                    {{-- students assigns starts --}}

                    @include('admin/features/students')
                    {{-- student assigns ends --}}

                    {{-- classromm assigns starts --}}
                    @include('admin/features/classroom_assignment')
                    {{-- classroom assigns ends --}}

                    {{-- class schedule are starts --}}
                    <div id="schedule" class="content-section">
                        <h4>Class Schedule</h4>

                        <!-- Department Dropdown -->
                        <div class="mb-3 col-md-5">
                            <label for="departmentSelect" class="form-label">Select Department</label>
                            <select id="departmentSelect" class="form-select">
                                <option value="">-- Choose Department --</option>
                                <option value="CSE">Computer Science (CSE)</option>
                                <option value="EEE">Electrical Engineering (EEE)</option>
                                <option value="BBA">Business Administration (BBA)</option>
                            </select>
                        </div>

                        <!-- Schedule Table -->
                        <table class="table table-bordered table-striped" id="scheduleTable" style="display: none;">
                            <thead class="table-dark">
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Room</th>
                                </tr>
                            </thead>
                            <tbody id="scheduleBody">
                                <!-- Rows will be inserted here dynamically -->
                            </tbody>
                        </table>
                    </div>
                    {{-- class schedule are ends --}}

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar click script -->
    <script>
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.sidebar .nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.content-section').forEach(sec => sec.classList.remove(
                    'active'));
                const target = this.getAttribute('data-target');
                if (target) {
                    document.getElementById(target).classList.add('active');
                }
            });
        });
    </script>
    <script>
        // Example data (in real app, fetch from backend via AJAX)
        const schedules = {
            "CSE": [{
                    code: "CSE101",
                    name: "Intro to Programming",
                    day: "Sunday",
                    time: "10:00 AM - 11:30 AM",
                    room: "Lab 101"
                },
                {
                    code: "CSE202",
                    name: "Data Structures",
                    day: "Tuesday",
                    time: "1:00 PM - 2:30 PM",
                    room: "Room 204"
                }
            ],
            "EEE": [{
                    code: "EEE110",
                    name: "Circuit Analysis",
                    day: "Monday",
                    time: "9:00 AM - 10:30 AM",
                    room: "Room 302"
                },
                {
                    code: "EEE210",
                    name: "Electromagnetics",
                    day: "Wednesday",
                    time: "11:00 AM - 12:30 PM",
                    room: "Room 305"
                }
            ],
            "BBA": [{
                code: "BBA101",
                name: "Principles of Management",
                day: "Sunday",
                time: "2:00 PM - 3:30 PM",
                room: "Room 401"
            }]
        };

        document.getElementById("departmentSelect").addEventListener("change", function() {
            const dept = this.value;
            const table = document.getElementById("scheduleTable");
            const tbody = document.getElementById("scheduleBody");
            tbody.innerHTML = ""; // Clear old rows

            if (dept && schedules[dept]) {
                schedules[dept].forEach(row => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                    <td>${row.code}</td>
                    <td>${row.name}</td>
                    <td>${row.day}</td>
                    <td>${row.time}</td>
                    <td>${row.room}</td>
                `;
                    tbody.appendChild(tr);
                });
                table.style.display = "table";
            } else {
                table.style.display = "none";
            }
        });
    </script>
    {{-- <script>
        document.getElementById('teacherForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('teachers.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    // Add new row to table dynamically
                    let row = `<tr>
            <td>${data.department_name}</td>
            <td>${data.teacher_name}</td>
            <td>${data.email || ''}</td>
            <td>${data.contact_no || ''}</td>
            <td>${data.designation || ''}</td>
            <td>${data.credit_to_be_taken}</td>
        </tr>`;
                    document.getElementById('teachersTableBody').insertAdjacentHTML('beforeend', row);

                    // Reset form
                    this.reset();
                    bootstrap.Collapse.getInstance(document.getElementById('addTeacherForm')).hide();
                })
                .catch(err => console.error(err));
        });
    </script> --}}


</body>

</html>
