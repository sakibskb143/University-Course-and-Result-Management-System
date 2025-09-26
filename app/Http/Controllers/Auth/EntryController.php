<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::check()) {
            $username = $request->input('username');
            $password = $request->input('password');
            if ($username && $password) {
                Auth::attempt(['username' => $username, 'password' => $password], false);
            }
        }

        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->route('admin.login');
    }

    public function teacher(Request $request)
    {
        if (!Auth::check()) {
            $username = $request->input('username');
            $password = $request->input('password');
            if ($username && $password) {
                Auth::attempt(['username' => $username, 'password' => $password], false);
            }
        }

        if (Auth::check() && Auth::user()->role === 'teacher') {
            return redirect()->to('/teacher/dashboard');
        }

        return redirect()->route('teacher.login');
    }

    public function student(Request $request)
    {
        if (!Auth::check()) {
            $username = $request->input('student_id') ?: $request->input('username');
            $password = $request->input('password');
            if ($username && $password) {
                Auth::attempt(['username' => $username, 'password' => $password], false);
            }
        }

        if (Auth::check() && Auth::user()->role === 'student') {
            return redirect()->to('/student/dashboard');
        }

        return redirect()->route('student.login');
    }
}


