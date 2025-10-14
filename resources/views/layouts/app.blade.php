<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'University CMS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0cd1eac34e.js" crossorigin="anonymous"></script>
    <style>
        :root { --primary-color: rgba(18, 88, 117, 0.9); --accent-color: rgb(255, 115, 80); }
        body { font-family: "Open Sans", sans-serif; }
        .navbar-brand .brand-title { font-weight:700; color: var(--accent-color); }
        .navbar-brand .brand-title span { color: var(--primary-color); }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light border-bottom mb-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('portal.home') }}">
            <i class="fa-solid fa-graduation-cap me-2"></i>
            <span class="brand-title"><span>P</span><span class="highlight">UC</span></span>
        </a>
        <div class="ms-auto">
            @auth
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-primary btn-sm" type="submit">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

