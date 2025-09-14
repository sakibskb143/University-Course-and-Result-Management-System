<?php

namespace App\Http\Controllers;

use App\Models\CourseAssignment;
use App\Models\Department;
use App\Models\Teacher;
use App\Models\Course;
use App\Http\Requests\StoreCourseAssignmentRequest;
use App\Http\Requests\UpdateCourseAssignmentRequest;

class CourseAssignmentController extends Controller
{
    public function index()
    {
        $assignments = CourseAssignment::with('department','teacher','course')->get();
        return view('admin.features.course_assignments', compact('assignments'));
    }

    public function create()
    {
        $departments = Department::orderBy('department_name')->get();
        $teachers = Teacher::orderBy('teacher_name')->get();
        $courses = Course::orderBy('course_name')->get();
        return view('admin.features.create_course_assignment', compact('departments','teachers','courses'));
    }

    public function store(StoreCourseAssignmentRequest $request)
    {
        CourseAssignment::create($request->validated());
        return redirect()->route('course_assignments.index')->with('success', 'Course assigned successfully!');
    }

    public function edit(CourseAssignment $course_assignment)
    {
        $departments = Department::orderBy('department_name')->get();
        $teachers = Teacher::orderBy('teacher_name')->get();
        $courses = Course::orderBy('course_name')->get();
        return view('admin.features.edit_course_assignment', compact('course_assignment','departments','teachers','courses'));
    }

    public function update(UpdateCourseAssignmentRequest $request, CourseAssignment $course_assignment)
    {
        $course_assignment->update($request->validated());
        return redirect()->route('course_assignments.index')->with('success', 'Course assignment updated successfully!');
    }

    public function destroy(CourseAssignment $course_assignment)
    {
        $course_assignment->delete();
        return redirect()->route('course_assignments.index')->with('success', 'Course assignment deleted successfully!');
    }
}
