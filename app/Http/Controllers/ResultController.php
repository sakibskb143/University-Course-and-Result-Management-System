<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class ResultController extends Controller
{
    public function adminPublishIndex(Request $request)
    {
        $semesterId = (int) $request->get('semester_id', 0);

        $semesters = DB::table('semesters')->orderBy('id')->get();

        $results = collect();
        if ($semesterId > 0) {
            $results = DB::table('results')
                ->join('students', 'results.student_id', '=', 'students.id')
                ->join('courses', 'results.course_id', '=', 'courses.id')
                ->leftJoin('semesters', 'results.semester_id', '=', 'semesters.id')
                ->select(
                    'results.id',
                    'students.student_name as student_name',
                    'courses.course_name as course_name',
                    'courses.course_code as course_code',
                    'results.marks',
                    'results.letter_grade',
                    'results.grade_point',
                    'results.published',
                    'semesters.semester_name as semester_name'
                )
                ->where('results.semester_id', $semesterId)
                ->orderBy('students.student_name')
                ->get();
        }

        return view('admin.features.results_publish', compact('semesters', 'results', 'semesterId'));
    }

    public function adminPublishStore(int $semesterId)
    {
        DB::table('results')->where('semester_id', $semesterId)->update(['published' => true]);
        return redirect()->back()->with('success', 'Results published successfully for the selected semester.');
    }

    public function adminUnpublishStore(int $semesterId)
    {
        DB::table('results')->where('semester_id', $semesterId)->update(['published' => false]);
        return redirect()->back()->with('success', 'Results unpublished successfully for the selected semester.');
    }

    public function studentResults(Request $request)
    {
        $user = $request->user();
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            abort(404);
        }

        // Determine current/enrolled semester from student's record or latest enrollment
        $semesterId = null;
        if (!empty($student->semester)) {
            $semesterId = (int) $student->semester;
        } else {
            $enrollment = DB::table('course_enrollments')->where('student_id', $student->id)->orderByDesc('id')->first();
            if ($enrollment) {
                $semesterId = (int) $enrollment->semester_id;
            }
        }

        $results = collect();
        if ($semesterId) {
            $results = DB::table('results')
                ->join('courses', 'results.course_id', '=', 'courses.id')
                ->join('semesters', 'results.semester_id', '=', 'semesters.id')
                ->select('courses.course_name', 'courses.course_code', 'results.marks', 'results.letter_grade', 'results.grade_point')
                ->where('results.student_id', $student->id)
                ->where('results.semester_id', $semesterId)
                ->where('results.published', true)
                ->orderBy('courses.course_code')
                ->get();
        }

        return view('student.results', compact('results', 'semesterId'));
    }
}


