<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
    <div class="login-card">
        <h2 class="text-center mb-3">Student Login</h2>
        <p class="text-center text-muted">Sign in to access your student dashboard</p>

        <form action="{{ route('student.dashboard') }}" method="GET">
            @csrf
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student ID" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Student Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
                <a href="#" class="text-decoration-none primary-color">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold">Sign In</button>
        </form>
    </div>
</body>
</html>
