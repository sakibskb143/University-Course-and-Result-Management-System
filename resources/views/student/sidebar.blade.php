<div class="col-md-2 sidebar p-3">
    <div class="mb-4 ">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fa-solid fa-graduation-cap me-2"></i>
            <span class="brand-title">
                <span>P</span><span class="highlight">UC</span>
            </span>
        </a>
    </div>

    <ul class="nav flex-column gap-1 ">
        <li class="nav-item">
            <a href="{{ route('student.dashboard') }}" class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.class-schedule') }}" class="nav-link {{ request()->routeIs('student.class-schedule') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-days"></i> Class Schedule
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.enroll-courses') }}" class="nav-link {{ request()->routeIs('student.enroll-courses') ? 'active' : '' }}">
                <i class="fa-solid fa-book"></i> Enroll in Courses
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.view-results') }}" class="nav-link {{ request()->routeIs('student.view-results') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> View Results
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.profile') }}" class="nav-link {{ request()->routeIs('student.profile') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i> Profile
            </a>
        </li>

        <li class="mt-4 border-top pt-2 nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-start w-100 p-0 border-0" style="background:none;">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>

