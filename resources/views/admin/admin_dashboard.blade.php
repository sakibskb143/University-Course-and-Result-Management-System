@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-white" style="background:#125875;">
                <h6 class="mb-1">Departments</h6>
                <h2 class="mb-0">{{ $departments->count() }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-white" style="background:#84AE92;">
                <h6 class="mb-1">Courses</h6>
                <h2 class="mb-0">{{ $courses->count() }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-white" style="background:#987070;">
                <h6 class="mb-1">Students</h6>
                <h2 class="mb-0">{{ $students->count() }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-white" style="background:#FF7350;">
                <h6 class="mb-1">Teachers</h6>
                <h2 class="mb-0">{{ $teachers->count() }}</h2>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-2">
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-semibold">Manage Departments</div>
                <div class="card-body">
                    <p class="text-muted">Add, edit, and view departments.</p>
                    <a href="{{ route('admin.departments.index') }}" class="btn btn-primary btn-sm">Open</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-semibold">Manage Students</div>
                <div class="card-body">
                    <p class="text-muted">Add, edit, and view students.</p>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-primary btn-sm">Open</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-semibold">Manage Teachers</div>
                <div class="card-body">
                    <p class="text-muted">Add, edit, and view teachers.</p>
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-primary btn-sm">Open</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-semibold">Manage Courses</div>
                <div class="card-body">
                    <p class="text-muted">Create and assign courses.</p>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-primary btn-sm">Open</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
