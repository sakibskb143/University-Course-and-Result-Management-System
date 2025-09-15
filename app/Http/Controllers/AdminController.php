<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;

class AdminController extends Controller
{
    public function index()
{
    $departments = Department::all();
    $students = Student::all();
    $courses = Course::all();
    $teachers = Teacher::all();

    return view('admin.admin_dashboard', compact('departments','students','courses','teachers'));
}

}
