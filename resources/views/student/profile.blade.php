@extends('student.layout')

@section('title', 'Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-semibold">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="{{ old('name', auth()->user()->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ old('email', auth()->user()->email) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact_no" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" 
                                       value="{{ old('contact_no', $student->contact_no) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="student_reg_no" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" id="student_reg_no" name="student_reg_no" 
                                       value="{{ $student->student_reg_no }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control" id="department" name="department" 
                                       value="{{ $student->department->name ?? 'N/A' }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="year" class="form-label">Academic Year</label>
                                <input type="text" class="form-control" id="year" name="year" 
                                       value="{{ $student->year ?? 'N/A' }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image" 
                                   accept="image/*">
                            <div class="form-text">Upload a new profile image (max 2MB, jpeg/png/jpg/gif)</div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-semibold">
                    <h5 class="mb-0">Current Profile</h5>
                </div>
                <div class="card-body text-center">
                    @if(auth()->user()->profile_image)
                        <img src="{{ Storage::url(auth()->user()->profile_image) }}" alt="Profile" 
                             class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto" 
                             style="width: 150px; height: 150px;">
                            <i class="fa-solid fa-user fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted mb-2">{{ auth()->user()->email }}</p>
                    <p class="text-muted mb-0">{{ $student->student_reg_no }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection