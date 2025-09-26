@extends('admin.layout')

@section('title', 'Add Student')

@section('content')
<div class="content-section">
    <h4>Add Student</h4>

    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf
        @include('admin.features.partials.student_form')
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
