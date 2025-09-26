@extends('admin.layout')

@section('title', 'Create Department')

@section('content')
<div class="card p-4">
    <h4>Create Department</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.departments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="department_code" class="form-label">Department Code</label>
            <input type="text" name="department_code" class="form-control" id="department_code"
                   value="{{ old('department_code') }}" required>
        </div>

        <div class="mb-3">
            <label for="department_name" class="form-label">Department Name</label>
            <input type="text" name="department_name" class="form-control" id="department_name"
                   value="{{ old('department_name') }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Department</button>
        </div>
    </form>
</div>
@endsection
