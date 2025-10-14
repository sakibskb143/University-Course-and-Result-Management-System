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

    <form action="{{ route('admin.classroom_assignments.store') }}" method="POST" class="card p-4 shadow-sm">
    @csrf
    @include('admin.features.partials.classroom_form', ['allocation' => null])

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary flex-fill">Allocate</button>
        <a href="{{ route('admin.classroom_assignments.index') }}" class="btn btn-secondary flex-fill">Cancel</a>
    </div>
</form>

</div>
@endsection
