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
            <a href="{{ route('admin.dashboard') }}" class="nav-link active"><i class="fa-solid fa-gauge"></i>
                Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.departments.index') }}" class="nav-link"><i class="fa-solid fa-building"></i>
                Departments</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.courses.index') }}" class="nav-link">
                <i class="fa-solid fa-book"></i> Courses
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.teachers.index') }}" class="nav-link">
                <i class="fa-solid fa-chalkboard-teacher"></i> Teachers
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.students.index') }}" class="nav-link">
                <i class="fa-solid fa-user-graduate"></i> Students
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.course_assignments.index') }}" class="nav-link">
                <i class="fa-solid fa-link"></i> Course Assignment
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.classroom_assignments.index') }}" class="nav-link">
                <i class="fa-solid fa-door-open"></i> Classroom Allocation
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.results.publish') }}" class="nav-link">
                <i class="fa-solid fa-bullhorn"></i> Result Publish
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.profile') }}" class="nav-link">
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
