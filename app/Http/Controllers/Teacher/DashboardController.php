<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CourseAssignment;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // naive binding: find teacher model by user_id if exists
        $teacherId = optional(\App\Models\Teacher::where('user_id', $user->id)->first())->id;
        $assignments = [];
        $assignedCount = 0;
        if ($teacherId) {
            $assignments = CourseAssignment::with(['course','department'])->where('teacher_id', $teacherId)->get();
            $assignedCount = $assignments->count();
        }

        return view('teacher.teacher_dashboard', compact('user','assignments','assignedCount'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('teacher.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('teacher.profile')->with('status', 'Profile updated');
    }
}


