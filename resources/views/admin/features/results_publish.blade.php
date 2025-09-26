@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-8">
            <h4>Result Publish</h4>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.results.publish') }}" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Select Semester</label>
                <select name="semester_id" class="form-select" required>
                    <option value="">-- Choose --</option>
                    @foreach($semesters as $sem)
                        <option value="{{ $sem->id }}" {{ (int)$semesterId === (int)$sem->id ? 'selected' : '' }}>
                            {{ $sem->semester_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" type="submit">Load Results</button>
            </div>
        </div>
    </form>

    @if($semesterId && count($results))
        <div class="d-flex gap-2 mb-3">
            <form method="POST" action="{{ route('admin.results.publish.store', ['semester' => $semesterId]) }}">
                @csrf
                <button type="submit" class="btn btn-success">Publish Results</button>
            </form>
            <form method="POST" action="{{ route('admin.results.unpublish.store', ['semester' => $semesterId]) }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Unpublish Results</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Course Code</th>
                        <th>Course</th>
                        <th>Marks</th>
                        <th>Grade</th>
                        <th>Published</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $r)
                        <tr>
                            <td>{{ $r->student_name }}</td>
                            <td>{{ $r->course_code }}</td>
                            <td>{{ $r->course_name }}</td>
                            <td>{{ $r->marks }}</td>
                            <td>{{ $r->letter_grade }}</td>
                            <td>
                                @if($r->published)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif($semesterId)
        <div class="alert alert-info">No results found for the selected semester.</div>
    @endif
</div>
@endsection


