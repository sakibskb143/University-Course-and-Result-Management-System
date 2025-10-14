@extends('teacher.layout')

@section('title', 'Profile')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="primary-color"><i class="fa-solid fa-user me-2"></i>My Profile</h3>
    </div>

    <div class="row">
        <!-- Profile Information -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fa-solid fa-edit me-2"></i>Edit Profile Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('teacher.profile.update') }}">
                        @csrf
                        
                        <!-- Personal Information -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Teacher Information -->
                        @if($teacher)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="teacher_name" class="form-label">Teacher Name</label>
                                <input type="text" class="form-control @error('teacher_name') is-invalid @enderror" 
                                       id="teacher_name" name="teacher_name" value="{{ old('teacher_name', $teacher->teacher_name) }}">
                                @error('teacher_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control @error('designation') is-invalid @enderror" 
                                       id="designation" name="designation" value="{{ old('designation', $teacher->designation) }}">
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact_no" class="form-label">Contact Number</label>
                                <input type="text" class="form-control @error('contact_no') is-invalid @enderror" 
                                       id="contact_no" name="contact_no" value="{{ old('contact_no', $teacher->contact_no) }}">
                                @error('contact_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Department</label>
                                <input type="text" class="form-control" value="{{ $teacher->department->department_name ?? 'N/A' }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3">{{ old('address', $teacher->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif

                        <!-- Password Section -->
                        <hr class="my-4">
                        <h6 class="text-muted mb-3"><i class="fa-solid fa-lock me-2"></i>Change Password (Optional)</h6>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa-solid fa-save me-2"></i>Update Profile
                            </button>
                            <a href="{{ route('teacher.dashboard') }}" class="btn btn-secondary btn-lg ms-2">
                                <i class="fa-solid fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Profile Summary -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fa-solid fa-user-circle me-2"></i>Profile Summary</h6>
                </div>
                <div class="card-body text-center">
                    <div class="profile-avatar mb-3">
                        <i class="fa-solid fa-user-circle" style="font-size: 100px; color: var(--primary-color);"></i>
                    </div>
                    <h5 class="fw-bold">{{ $user->name ?? 'N/A' }}</h5>
                    <p class="text-muted">{{ $user->email ?? 'N/A' }}</p>
                    @if($teacher)
                        <p class="text-muted mb-0">{{ $teacher->designation ?? 'N/A' }}</p>
                        <p class="text-muted">{{ $teacher->department->department_name ?? 'N/A' }}</p>
                    @endif
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0"><i class="fa-solid fa-chart-bar me-2"></i>Quick Stats</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h5 class="text-primary">{{ $assignedCount ?? 0 }}</h5>
                            <small class="text-muted">Assigned Courses</small>
                        </div>
                        <div class="col-6">
                            <h5 class="text-success">{{ $weeklyClasses ?? 0 }}</h5>
                            <small class="text-muted">Weekly Classes</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="card mt-3">
                <div class="card-header bg-warning text-white">
                    <h6 class="mb-0"><i class="fa-solid fa-info-circle me-2"></i>Account Info</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted">Member Since:</small>
                        <br>
                        <span class="fw-bold">{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Last Updated:</small>
                        <br>
                        <span class="fw-bold">{{ $user->updated_at ? $user->updated_at->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    @if($teacher)
                    <div>
                        <small class="text-muted">Credit to be Taken:</small>
                        <br>
                        <span class="fw-bold">{{ $teacher->credit_to_be_taken ?? 'N/A' }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password confirmation validation
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');
    
    function validatePassword() {
        if (passwordField.value !== confirmPasswordField.value) {
            confirmPasswordField.setCustomValidity("Passwords don't match");
        } else {
            confirmPasswordField.setCustomValidity('');
        }
    }
    
    passwordField.addEventListener('change', validatePassword);
    confirmPasswordField.addEventListener('keyup', validatePassword);
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        if (passwordField.value && passwordField.value !== confirmPasswordField.value) {
            e.preventDefault();
            alert('Passwords do not match!');
            return false;
        }
    });
});
</script>
@endpush