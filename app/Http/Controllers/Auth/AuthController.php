<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required','string'], // username or email
            'password' => ['required','string'],
        ]);

        $user = User::where('username', $credentials['login'])
            ->orWhere('email', $credentials['login'])
            ->first();

        if ($user) {
            $passwordOk = (string)$user->password === (string)$credentials['password'];
            if ($passwordOk) {
                Auth::login($user);
                $request->session()->regenerate();
                return match ($user->role) {
                    'admin' => redirect()->intended('/admin/dashboard'),
                    'teacher' => redirect()->intended('/teacher/dashboard'),
                    'student' => redirect()->intended('/student/dashboard'),
                    default => redirect('/'),
                };
            }
        }

        return back()->withErrors(['login' => 'Invalid credentials.'])->withInput();
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin_login');
    }

    public function showTeacherLoginForm()
    {
        return view('auth.teacher_login');
    }

    public function showStudentLoginForm()
    {
        return view('auth.student_login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required','string'],
            'password' => ['required','string'],
        ]);

        $user = User::where('username', $credentials['username'])->first();
        
        // Debug information
        if ($user) {
            \Log::info('Login attempt', [
                'username' => $credentials['username'],
                'user_found' => true,
                'stored_password' => $user->password,
                'input_password' => $credentials['password'],
                'password_match' => $user->password === $credentials['password'],
                'user_role' => $user->role,
                'role_match' => $user->role === 'admin'
            ]);
        } else {
            \Log::info('Login attempt - user not found', [
                'username' => $credentials['username']
            ]);
        }
        
        if ($user && $user->password === $credentials['password'] && $user->role === 'admin') {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials or role.'])->withInput();
    }

    public function teacherLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required','string'],
            'password' => ['required','string'],
        ]);

        $user = User::where('username', $credentials['username'])->first();
        if ($user && $user->password === $credentials['password'] && $user->role === 'teacher') {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/teacher/dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials or role.'])->withInput();
    }

    public function studentLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required','string'],
            'password' => ['required','string'],
        ]);

        $user = User::where('username', $credentials['username'])->first();
        if ($user && $user->password === $credentials['password'] && $user->role === 'student') {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/student/dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials or role.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('portal.home');
    }
}



