<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CourseAssignment;
use App\Models\Course;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->with('department')->first();
        $assignments = [];
        $assignedCount = 0;
        if ($teacher) {
            $assignments = CourseAssignment::with(['course','department'])->where('teacher_id', $teacher->id)->get();
            $assignedCount = $assignments->count();
        }

        return view('teacher.teacher_dashboard', compact('user','teacher','assignments','assignedCount'));
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
            'profile_image' => ['nullable','image','max:2048'],
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = basename($path);
        }

        $user->save();

        return redirect()->route('teacher.profile')->with('status', 'Profile updated');
    }
}


