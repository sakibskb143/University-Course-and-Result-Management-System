<!doctype html>
<html lang="en">

<head>
    <title>Premier University</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0cd1eac34e.js" crossorigin="anonymous"></script>

    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/university_portal.css') }}">
</head>

<body class="">

    <header>
        @include('layouts.navbar')
    </header>

    <main>
        <div class="">
            @yield('content-1')
        </div>
    </main>
    @include('layouts.footer')
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
