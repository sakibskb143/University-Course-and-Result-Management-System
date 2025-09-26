@extends('admin.layout')

@section('title', 'Classroom Allocations')

@section('content')
<div id="classroom" class="content-section">
    <h4>Classroom Allocation</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.classroom_assignments.create') }}" class="btn btn-primary mb-3">Allocate Classroom</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Department</th>
                <th>Semester</th>
                <th>Course</th>
                <th>Room</th>
                <th>Day</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($allocations as $allocation)
                <tr>
                    <td>{{ $allocation->department->department_name }}</td>
                    <td>{{ optional($allocation->course)->semester ?? optional($allocation->semester)->semester_name ?? $allocation->semester_id }}</td>
                    <td>{{ $allocation->course->course_name }}</td>
                   <td>{{ $allocation->room->room_no }}</td>
                    <td>{{ $allocation->day }}</td>
                    <td>{{ $allocation->time_from }}</td>
                    <td>{{ $allocation->time_to }}</td>
                    <td>{{ $allocation->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('admin.classroom_assignments.edit', $allocation) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.classroom_assignments.destroy', $allocation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this allocation?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No classroom allocations found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $allocations->links() }}
</div>
@endsection
