@extends('admin.layout')

@section('title', 'Edit Student')

@section('content')
<div class="content-section">
    <h4>Edit Student</h4>

    <form action="{{ route('admin.students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.features.partials.student_form')
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
