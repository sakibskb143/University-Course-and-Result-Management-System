<div class="sidebar" id="sidebar">
    <div class="mb-4">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('teacher.dashboard') }}">
            <i class="fa-solid fa-graduation-cap me-2"></i>
            <span class="brand-title">
                <span>P</span><span class="highlight">UC</span>
            </span>
        </a>
    </div>

    <ul class="nav flex-column gap-1">
        <li class="nav-item">
            <a href="{{ route('teacher.dashboard') }}" class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('teacher.assigned-classes') }}" class="nav-link {{ request()->routeIs('teacher.assigned-classes') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard-teacher"></i> Assigned Classes
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('teacher.class-schedule') }}" class="nav-link {{ request()->routeIs('teacher.class-schedule') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar"></i> Class Schedule
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('teacher.save-results') }}" class="nav-link {{ request()->routeIs('teacher.save-results') ? 'active' : '' }}">
                <i class="fa-solid fa-pen-to-square"></i> Save Student Results
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('teacher.profile') }}" class="nav-link {{ request()->routeIs('teacher.profile') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i> Profile
            </a>
        </li>

        <li class="mt-4 border-top pt-2 nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-start w-100 p-0 border-0" style="background:none;" 
                        onclick="return confirm('Are you sure you want to logout?')">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>
