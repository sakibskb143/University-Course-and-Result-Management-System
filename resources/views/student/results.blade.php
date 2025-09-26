@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>My Published Results</h4>
            @if(!$semesterId)
                <div class="alert alert-warning">No semester detected for your profile.</div>
            @endif
            @if(isset($results) && count($results))
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course</th>
                                <th>Marks</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $r)
                                <tr>
                                    <td>{{ $r->course_code }}</td>
                                    <td>{{ $r->course_name }}</td>
                                    <td>{{ $r->marks }}</td>
                                    <td>{{ $r->letter_grade }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">No published results found for your semester.</div>
            @endif
        </div>
    </div>
</div>
@endsection


