<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Display all courses
    public function index()
    {
        $courses = Course::with('department')->orderBy('created_at', 'asc')->get();
        return view('admin.features.courses', compact('courses')); // only list page
    }

    // Show Add Course page
    public function create()
    {
        $departments = Department::orderBy('department_name')->get();
        $semesters = DB::table('semesters')->orderBy('id')->get(); // fetch semesters
        return view('admin.features.create_course', compact('departments', 'semesters'));
    }

    // Store a new course
    public function store(StoreCourseRequest $request)
    {
        Course::create($request->validated());

        return redirect()->route('courses.index')
                         ->with('success', 'Course added successfully!');
    }

    // Show Edit Course page
    public function edit(Course $course)
    {
        $departments = Department::orderBy('department_name')->get();
        $semesters = DB::table('semesters')->orderBy('id')->get();

        // ✅ return edit view with $course
        return view('admin.features.edit_course', compact('course', 'departments', 'semesters'));
    }

    // Update a course
    public function update(StoreCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return redirect()->route('courses.index')
                         ->with('success', 'Course updated successfully!');
    }

    // Delete a course
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
                         ->with('success', 'Course deleted successfully!');
    }
}
