<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseAssignmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassroomAllocationController;
use App\Http\Controllers\EnrollmentController;  // ✅ Added for student enrollment

// Home
Route::get('/', function () {
    return view('pages.home');
});

// Dashboards
Route::get('/student', function () {
    return view('student.student_dashboard');
})->name('student.dashboard');

Route::get('/teacher', function () {
    return view('teacher.teacher_dashboard');
})->name('teacher.dashboard');

// ------------------------- Login --------------------------------------------
Route::get('/admin/login', function () {
    return view('auth.admin_login');
})->name('admin_login.login');

Route::get('/student/login', function () {
    return view('auth.student_login');
})->name('student.login');

Route::get('/teacher/login', function () {
    return view('auth.teacher_login');
})->name('teacher.login');

// ------------------------- Admin Section ------------------------------------

// Admin Dashboard
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

// Departments CRUD
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

// Courses CRUD
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

// Teachers, Assignments, Students, Classrooms
Route::resource('teachers', TeacherController::class);
Route::resource('course_assignments', CourseAssignmentController::class);
Route::resource('students', StudentController::class);
Route::resource('classroom_assignments', ClassroomAllocationController::class);

// ------------------------- Student Enrollment Section -----------------------
Route::prefix('student')->group(function() {
    Route::get('/enroll', [EnrollmentController::class, 'showEnrollment'])->name('student.enroll');
    Route::post('/enroll', [EnrollmentController::class, 'enrollCourse'])->name('student.enroll.submit');
    Route::get('/my-enrollments', [EnrollmentController::class, 'showMyEnrollments'])->name('student.my_enrollments');
    Route::get('/results', [EnrollmentController::class, 'showResults'])->name('student.results');
    Route::get('/schedule', [EnrollmentController::class, 'showSchedule'])->name('student.schedule');
});
