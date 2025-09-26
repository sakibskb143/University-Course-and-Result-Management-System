<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student as StudentModel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = StudentModel::where('user_id', $user->id)->first();
        $enrollments = collect();
        $results = collect();
        $summary = [
            'enrolledCount' => 0,
            'totalCredits' => 0,
            'cgpa' => null,
        ];

        if ($student) {
            $enrollments = DB::table('course_enrollments')
                ->join('courses', 'course_enrollments.course_id', '=', 'courses.id')
                ->select('course_enrollments.*', 'courses.course_code', 'courses.course_name', 'courses.credit')
                ->where('course_enrollments.student_id', $student->id)
                ->get();

            $results = DB::table('results')
                ->join('courses', 'results.course_id', '=', 'courses.id')
                ->select('results.*', 'courses.course_code', 'courses.course_name', 'courses.credit')
                ->where('results.student_id', $student->id)
                ->get();

            $summary['enrolledCount'] = $enrollments->count();
            $summary['totalCredits'] = $enrollments->sum('credit');

            if ($results->count() > 0) {
                $totalQualityPoints = $results->sum(function ($r) { return ($r->grade_point ?? 0) * ($r->credit ?? 0); });
                $totalAttemptedCredits = $results->sum('credit');
                $summary['cgpa'] = $totalAttemptedCredits > 0 ? round($totalQualityPoints / $totalAttemptedCredits, 2) : null;
            }
        }

        return view('student.student_dashboard', compact('user','student','enrollments','results','summary'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('student.profile', compact('user'));
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

        return redirect()->route('student.profile')->with('status', 'Profile updated');
    }
}


