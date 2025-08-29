<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('pages.home');
});

Route::get('/admin', function () {
    return view('admin.admin_dashboard');
})->name('admin.dashboard');

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