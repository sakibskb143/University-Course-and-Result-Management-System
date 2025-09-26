<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Department;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        $departments = Department::query()->get();
        $courses = Course::query()->get();
        $students = Student::query()->get();
        $teachers = Teacher::query()->get();
        return view('admin.admin_dashboard', compact('departments','courses','students','teachers'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = $validated['password']; // Plain text for testing
        }

        if ($request->hasFile('profile_image')) {
            // Remove old file if exists
            if (!empty($user->profile_image)) {
                \Storage::disk('public')->delete('profile_images/' . $user->profile_image);
            }

            // Store new file on public disk
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = basename($path);

            \Log::info('Profile image uploaded', [
                'path' => $path,
                'filename' => basename($path),
                'user_id' => $user->id
            ]);
        }

        $user->save();

        \Log::info('Profile updated', [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'profile_image' => $user->profile_image
        ]);

        return redirect()->route('admin.profile')->with('status', 'Profile updated successfully!');
    }
}


