<?php

namespace App\Http\Controllers;

use App\Models\ClassroomAllocation;
use App\Models\Department;
use App\Models\Course;
use App\Models\Room;
use App\Http\Requests\ClassroomAllocationRequest;

class ClassroomAllocationController extends Controller
{
    public function index()
    {
        $allocations = ClassroomAllocation::with(['department', 'course', 'room'])->paginate(10);
        return view('admin.features.classroom_assignments', compact('allocations'));
        // points to: resources/views/admin/features/classroom_assignments.blade.php
    }

    public function create()
    {
        $departments = Department::all();
        $courses = Course::all();
        $rooms = Room::all();
        return view('admin.features.create_classroom_assignment', compact('departments', 'courses', 'rooms'));
        // points to: resources/views/admin/features/create_classroom_assignment.blade.php
    }

    public function store(ClassroomAllocationRequest $request)
    {
        ClassroomAllocation::create($request->validated());
        return redirect()->route('classroom_assignments.index')->with('success', 'Classroom allocated successfully!');
    }

   public function edit(ClassroomAllocation $classroom_assignment)
{
    $departments = Department::all();
    $courses = Course::all();
    $rooms = Room::all();

    return view('admin.features.edit_classroom_assignment', [
        'allocation' => $classroom_assignment,
        'departments' => $departments,
        'courses' => $courses,
        'rooms' => $rooms,
    ]);
}

    public function update(ClassroomAllocationRequest $request, ClassroomAllocation $classroom_assignment)
    {
        $classroom_assignment->update($request->validated());
        return redirect()->route('classroom_assignments.index')->with('success', 'Classroom allocation updated successfully!');
    }

    public function destroy(ClassroomAllocation $classroom_assignment)
    {
        $classroom_assignment->delete();
        return redirect()->route('classroom_assignments.index')->with('success', 'Classroom allocation deleted!');
    }
}
