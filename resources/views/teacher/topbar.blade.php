<div class="top-bar">
    <div class="d-flex align-items-center">
        <button class="sidebar-toggle me-3" id="sidebar-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <h5 class="m-0 fs-2 uppercase primary-color fw-bold">Teacher Dashboard</h5>
    </div>
    <div class="admin-info">
        <i class="fa-solid fa-user-circle"></i>
        <div class="admin-details primary-color">
            <strong>{{ auth()->user()->name ?? 'Teacher' }}</strong>
            <small>{{ auth()->user()->email ?? 'teacher@university.com' }}</small>
        </div>
    </div>
</div>
