<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fa-solid fa-graduation-cap me-2"></i>
            <span class="brand-title">
                <span>Premier</span> <span class="highlight">University</span>
            </span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Menu -->
        <div class="collapse navbar-collapse justify-content-between" id="navbarContent">

            <!-- Center Menu Items -->
            <ul class="navbar-nav mb-2 mb-lg-0 mx-lg-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Academics</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Admissions</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Notice</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>

                <!-- Login Buttons for Small Devices -->
                <li class="nav-item d-lg-none mt-2">
                    <a href="{{ route('student.login') }}" class="btn w-100 mb-2">Student Login</a>
                    <a href="{{ route('teacher.login') }}" class="btn w-100">Teacher Login</a>
                </li>
            </ul>

            <!-- Login Buttons for Large Devices -->
            <div class="d-none d-lg-flex">
                <a href="{{ route('student.login') }}" class="btn btn-login me-2">Student Login</a>
                <a href="{{ route('teacher.login') }}" class="btn btn-login">Teacher Login</a>
            </div>

        </div>
    </div>
</nav>
