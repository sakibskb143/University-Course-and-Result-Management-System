<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('pages.home');
});

// Route::get('/admin', function () {
//     return view('admin.admin_dashboard');
// })->name('admin.dashboard');

Route::get('/student', function () {
    return view('student.student_dashboard');
})->name('student.dashboard');

Route::get('/teacher', function () {
    return view('teacher.teacher_dashboard');
})->name('teacher.dashboard');
// -------------------------login-------------------------------------------- 
Route::get('/admin/login', function () {
    return view('auth.admin_login');
})->name('admin_login.login');


Route::get('/student/login', function () {
    return view('auth.student_login');
})->name('student.login');

Route::get('/teacher/login', function () {
    return view('auth.teacher_login');
})->name('teacher.login');



// Admin Dashboard
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

// Departments CRUD (separate page)
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create'); // ✅ Add this
Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');




// Courses CRUD (separate pages)


// Courses CRUD (separate pages)
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

