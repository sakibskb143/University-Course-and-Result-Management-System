<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student as StudentModel;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\ClassroomAllocation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = StudentModel::where('user_id', $user->id)->first();
        $enrollments = collect();
        $results = collect();
        $schedule = collect();
        $availableCourses = collect();
        $summary = [
            'enrolledCount' => 0,
            'totalCredits' => 0,
            'cgpa' => null,
        ];

        if ($student) {
            // Handle enrollment via query parameters
            $enrollCourseId = (int) request()->get('enroll_course_id', 0);
            $enrollCourseIds = request()->get('enroll_course_ids', []);
            $examType = request()->get('exam_type', 'Regular');
            if ($enrollCourseId > 0 || (is_array($enrollCourseIds) && count($enrollCourseIds) > 0)) {
                $semesterId = null;
                if (!empty($student->semester)) {
                    $semesterId = (int) $student->semester;
                } else {
                    $lastEnrollment = DB::table('course_enrollments')
                        ->where('student_id', $student->id)
                        ->orderByDesc('id')
                        ->first();
                    if ($lastEnrollment) {
                        $semesterId = (int) $lastEnrollment->semester_id;
                    }
                }

                if ($semesterId) {
                    $idsToEnroll = [];
                    if ($enrollCourseId > 0) { $idsToEnroll[] = $enrollCourseId; }
                    if (is_array($enrollCourseIds) && count($enrollCourseIds) > 0) {
                        foreach ($enrollCourseIds as $cid) {
                            $cid = (int) $cid;
                            if ($cid > 0) { $idsToEnroll[] = $cid; }
                        }
                    }
                    $idsToEnroll = array_values(array_unique($idsToEnroll));

                    $successCount = 0;
                    $duplicateCount = 0;
                    foreach ($idsToEnroll as $cid) {
                        $course = Course::find($cid);
                        if (!$course || $course->department_id != $student->department_id) {
                            continue;
                        }
                        try {
                            $courseFee = ($course->credit ?? 0) * 2100;
                            CourseEnrollment::create([
                                'student_id' => $student->id,
                                'course_id' => $course->id,
                                'exam_type' => in_array($examType, ['Regular','Recourse','Retake']) ? $examType : 'Regular',
                                'status' => 'Approved',
                                'course_fee' => $courseFee,
                                'total_cost' => $courseFee,
                                'semester_id' => $semesterId,
                            ]);
                            $successCount++;
                        } catch (\Throwable $e) {
                            $duplicateCount++;
                        }
                    }

                    $message = $successCount > 0 ? ($successCount . ' course(s) enrolled successfully.') : null;
                    $error = $duplicateCount > 0 ? ($duplicateCount . ' duplicate/failed enrollment(s) skipped.') : null;
                    return redirect()->route('student.dashboard')
                        ->with($message ? 'status' : 'noop', $message ?? '')
                        ->with($error ? 'error' : 'noop2', $error ?? '');
                } else {
                    return redirect()->route('student.dashboard')->with('error', 'No semester found for your profile.');
                }
            }

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

            $currentSemesterId = !empty($student->semester) ? (int) $student->semester : null;
            $alreadyEnrolledCourseIds = $enrollments->pluck('course_id')->all();
            $courseQuery = Course::query()->where('department_id', $student->department_id);
            if ($currentSemesterId) {
                $courseQuery->where('semester_id', $currentSemesterId);
            }
            if (!empty($alreadyEnrolledCourseIds)) {
                $courseQuery->whereNotIn('id', $alreadyEnrolledCourseIds);
            }
            $availableCourses = $courseQuery->orderBy('course_code')->get();

            $scheduleQuery = ClassroomAllocation::query()
                ->with(['course','room'])
                ->where('department_id', $student->department_id);
            if ($currentSemesterId) {
                $scheduleQuery->where('semester_id', $currentSemesterId);
            }
            $schedule = $scheduleQuery->orderBy('day')->orderBy('time_from')->get();
        }

        return view('student.student_dashboard', compact('user','student','enrollments','results','summary','availableCourses','schedule'));
    }
}


