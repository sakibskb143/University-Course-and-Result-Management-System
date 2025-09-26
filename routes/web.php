<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseAssignmentController;
use App\Http\Controllers\ClassroomAllocationController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EntryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ResultController;


Route::get('/', [PortalController::class, 'index'])->name('portal.home');

// Route::get('/admin', function () {
//     return view('admin.admin_dashboard');
// })->name('admin.dashboard');

// Compatibility entry routes matching existing frontend GET actions
Route::get('/admin', [EntryController::class, 'admin']);
Route::get('/teacher', [EntryController::class, 'teacher'])->name('teacher.dashboard');
Route::get('/student', [EntryController::class, 'student'])->name('student.dashboard');
// Authentication: role-specific GET/POST
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Fallback GET logout to avoid issues with non-POST submissions
Route::get('/logout', [AuthController::class, 'logout']);

// Dedicated role-based login pages (needed by EntryController redirects and views)
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

Route::get('/teacher/login', [AuthController::class, 'showTeacherLoginForm'])->name('teacher.login');
Route::post('/teacher/login', [AuthController::class, 'teacherLogin'])->name('teacher.login.submit');

Route::get('/student/login', [AuthController::class, 'showStudentLoginForm'])->name('student.login');
Route::post('/student/login', [AuthController::class, 'studentLogin'])->name('student.login.submit');



// Role grouped routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // admin resources
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [AdminDashboardController::class, 'updateProfile'])->name('admin.profile.update');
    Route::resource('departments', App\Http\Controllers\Admin\DepartmentController::class)->names('admin.departments');
    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class)->names('admin.courses');
    Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class)->names('admin.teachers');
    Route::resource('students', App\Http\Controllers\Admin\StudentController::class)->names('admin.students');
    Route::resource('course_assignments', CourseAssignmentController::class)->names('admin.course_assignments');
    Route::resource('classroom_assignments', ClassroomAllocationController::class)->names('admin.classroom_assignments');

    // Results publish
    Route::get('/results/publish', [ResultController::class, 'adminPublishIndex'])->name('admin.results.publish');
    Route::post('/results/publish/{semester}', [ResultController::class, 'adminPublishStore'])->name('admin.results.publish.store');
    Route::post('/results/unpublish/{semester}', [ResultController::class, 'adminUnpublishStore'])->name('admin.results.unpublish.store');
});

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/profile', [TeacherDashboardController::class, 'profile'])->name('teacher.profile');
    Route::post('/profile', [TeacherDashboardController::class, 'updateProfile'])->name('teacher.profile.update');
});




// Courses CRUD (separate pages)


Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/profile', [StudentDashboardController::class, 'profile'])->name('student.profile');
    Route::post('/profile', [StudentDashboardController::class, 'updateProfile'])->name('student.profile.update');

    // Student published results
    Route::get('/results', [ResultController::class, 'studentResults'])->name('student.results');
});





// Public or fallback resources can be added above if needed
