<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('department')->paginate(10);
        return view('admin.features.students', compact('students'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.features.create_student', compact('departments'));
    }

    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function edit(Student $student)
    {
        $departments = Department::all();
        return view('admin.features.edit_student', compact('student', 'departments'));
    }

    public function update(StoreStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
