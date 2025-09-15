@extends('admin.layout')

@section('title', 'Allocate Classroom')

@section('content')
<div class="content-section">
    <h4>Allocate Classroom</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('classroom_assignments.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @include('admin.features.partials.classroom_form', ['allocation' => null])

        <button type="submit" class="btn btn-primary">Allocate</button>
        <a href="{{ route('classroom_assignments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
