<!doctype html>
<html lang="en">

<head>
    <title>@yield('title', 'Teacher Dashboard - University CMS')</title>
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
        .sidebar { min-height: 100vh; background: #E5E5E5; color: var(--primary-color); }
        .sidebar .nav-link { color: var(--primary-color); font-weight: 500; padding: 10px 15px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: var(--primary-color); border-radius: 5px; color: white; }
        .content-section { display: none; }
        .content-section.active { display: block; }
        .fa-graduation-cap { color: var(--accent-color); font-size: 32px; }
        .brand-title { font-size: 32px; font-weight: 700; color: var(--accent-color); }
        .brand-title span { color: var(--primary-color); }
        .brand-title .highlight { color: var(--accent-color); }
        .top-bar { background: white; padding: 10px 20px; border-bottom: 1px solid #ddd; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 10; }
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
            @include('teacher.sidebar')
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-0">
            <!-- Top Bar -->
            @include('teacher.topbar')

            <!-- Content -->
            <div class="p-4">
                @yield('content')
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
