<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showAdminLogin() { return view('auth.admin_login'); }
    public function showTeacherLogin() { return view('auth.teacher_login'); }
    public function showStudentLogin() { return view('auth.student_login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();
            $role = Auth::user()->role;
            return match ($role) {
                'admin' => redirect()->intended('/admin/dashboard'),
                'teacher' => redirect()->intended('/teacher/dashboard'),
                'student' => redirect()->intended('/student/dashboard'),
                default => redirect('/')
            };
        }

        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}


