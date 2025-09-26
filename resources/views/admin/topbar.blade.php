<div class="top-bar">
    <h5 class="m-3 fs-2 uppercase primary-color fw-bold">Admin Dashboard</h5>
    <div class="admin-info">
        <i class="fa-solid fa-user-circle"></i>
        <div class="admin-details primary-color">
            <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
            <small>{{ auth()->user()->email ?? 'admin@university.com' }}</small>
        </div>
    </div>
</div>
