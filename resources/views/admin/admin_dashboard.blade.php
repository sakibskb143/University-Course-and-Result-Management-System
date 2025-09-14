@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow-sm p-3 bg-primary text-white">
            <h5>Total Departments</h5>
            <h2>{{ $departments->count() }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm p-3 bg-secondary text-white">
            <h5>Total Courses</h5>
            <h2>85</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm p-3 bg-success text-white">
            <h5>Total Students</h5>
            <h2>1200</h2>
        </div>
    </div>
</div>
@endsection
