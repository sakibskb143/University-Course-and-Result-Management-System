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
            <a href="{{ route('departments.index') }}" class="nav-link"><i class="fa-solid fa-building"></i>
                Departments</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('courses.index') }}" class="nav-link">
                <i class="fa-solid fa-book"></i> Courses
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('teachers.index') }}" class="nav-link">
                <i class="fa-solid fa-chalkboard-teacher"></i> Teachers
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('course_assignments.index') }}" class="nav-link">
                <i class="fa-solid fa-link"></i> Course Assignment
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('students.index') }}" class="nav-link" data-target="students">
                <i class="fa-solid fa-user-graduate"></i> Students
            </a>
        </li>

        <li class="nav-item"><a href="#" class="nav-link" data-target="classroom"><i
                    class="fa-solid fa-door-open"></i> Classroom Allocation</a></li>
        <li class="nav-item"><a href="#" class="nav-link" data-target="schedule"><i
                    class="fa-solid fa-calendar"></i> Class Schedule</a></li>
        <li class="mt-4 border-top pt-2 nav-item border-white"><a href="#" class="nav-link "><i
                    class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
    </ul>
</div>
