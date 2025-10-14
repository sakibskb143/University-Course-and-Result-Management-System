<div class="top-bar">
    <h5 class="m-3 fs-2 uppercase primary-color fw-bold">Student Dashboard</h5>
    <div class="student-info">
        @if(auth()->user()->profile_image)
            <img src="{{ Storage::url(auth()->user()->profile_image) }}" alt="Profile" class="profile-img">
        @else
            <i class="fa-solid fa-user-circle"></i>
        @endif
        <div class="student-details primary-color">
            <strong>{{ auth()->user()->name ?? 'Student' }}</strong>
            <small>{{ auth()->user()->email ?? 'student@university.com' }}</small>
        </div>
    </div>
</div>

