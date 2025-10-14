@extends('student.layout')

@section('title', 'View Results')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-semibold">
            <h5 class="mb-0">Academic Results</h5>
        </div>
        <div class="card-body">
            @if($resultsBySemester->isEmpty())
                <div class="text-center py-5">
                    <i class="fa-solid fa-chart-line fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Results Available</h5>
                    <p class="text-muted">Your results are not published yet or you haven't completed any courses.</p>
                    <a href="{{ route('student.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
                </div>
            @else
                @foreach($resultsBySemester as $semesterName => $semesterResults)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 text-primary">{{ $semesterName }}</h5>
                            <div class="text-end">
                                <strong>Semester GPA:</strong> 
                                <span class="badge bg-{{ $semesterGPAs[$semesterName] >= 3.0 ? 'success' : ($semesterGPAs[$semesterName] >= 2.0 ? 'warning' : 'danger') }}">
                                    {{ number_format($semesterGPAs[$semesterName], 2) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Course</th>
                                        <th>Code</th>
                                        <th>Credit Hours</th>
                                        <th>Marks</th>
                                        <th>Grade</th>
                                        <th>Grade Point</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($semesterResults as $result)
                                        <tr>
                                            <td>{{ $result->course->course_name }}</td>
                                            <td>{{ $result->course->course_code }}</td>
                                            <td>{{ $result->course->credit_hours ?? 'N/A' }}</td>
                                            <td>
                                                <strong>{{ $result->marks }}/100</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $result->letter_grade == 'A' ? 'success' : ($result->letter_grade == 'B' ? 'info' : ($result->letter_grade == 'C' ? 'warning' : 'danger')) }}">
                                                    {{ $result->letter_grade }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong>{{ $result->grade_point }}</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

