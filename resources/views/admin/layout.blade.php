<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') - University CMS</title>

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
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px; /* fixed width */
            height: 100vh;
            background: #E5E5E5;
            color: var(--primary-color);
            padding: 20px 10px;
            overflow-y: auto;
            z-index: 1000;
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

        /* Brand */
        .fa-graduation-cap {
            color: var(--accent-color);
            font-size: 32px;
        }

        .brand-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--accent-color);
        }

        .brand-title span {
            color: var(--primary-color);
        }

        .brand-title .highlight {
            color: var(--accent-color);
        }

        /* Topbar */
        .top-bar {
            background: white;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 500;
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

        .primary-color {
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--accent-color);
        }

        /* Main Content */
        .main-content {
            margin-left: 250px; /* same as sidebar width */
            padding: 20px;
        }

        .content-wrapper {
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        @include('admin.topbar')

        <!-- Dashboard Content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
