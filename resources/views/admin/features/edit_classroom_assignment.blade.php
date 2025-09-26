@extends('admin.layout')

@section('title', 'Edit Classroom Allocation')

@section('content')
<div class="content-section">
    <h4>Edit Classroom Allocation</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.classroom_assignments.update', $allocation->id) }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')
        @include('admin.features.partials.classroom_form', ['allocation' => $allocation])

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.classroom_assignments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
