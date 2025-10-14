<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CourseAssignment;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\ClassroomAllocation;
use App\Models\CourseEnrollment;
use App\Models\Result;
use App\Models\Semester;

class DashboardController extends Controller
{
    private function getTeacher()
    {
        $user = Auth::user();
        return Teacher::with('department')->where('user_id', $user->id)->first();
    }

    public function index()
    {
        $user = Auth::user();
        $teacher = $this->getTeacher();
        $teacherId = $teacher->id ?? null;
        
        $assignments = collect();
        $assignedCount = 0;
        $weeklyClasses = 0;
        $resultsSaved = 0;
        
        if ($teacherId) {
            $assignments = CourseAssignment::with(['course', 'department'])->where('teacher_id', $teacherId)->get();
            $assignedCount = $assignments->count();
            
            // Calculate weekly classes (simplified - you can enhance this)
            $weeklyClasses = ClassroomAllocation::whereHas('course', function($query) use ($teacherId) {
                $query->whereHas('courseAssignments', function($q) use ($teacherId) {
                    $q->where('teacher_id', $teacherId);
                });
            })->count();
            
            // Count results saved by this teacher's courses
            $resultsSaved = Result::whereHas('course', function($query) use ($teacherId) {
                $query->whereHas('courseAssignments', function($q) use ($teacherId) {
                    $q->where('teacher_id', $teacherId);
                });
            })->count();
        }

        return view('teacher.teacher_dashboard', compact('user', 'teacher', 'assignments', 'assignedCount', 'weeklyClasses', 'resultsSaved'));
    }

    public function assignedClasses()
    {
        $teacher = $this->getTeacher();
        $assignments = collect();
        
        if ($teacher) {
            $assignments = CourseAssignment::with(['course', 'department', 'course.semester'])
                ->where('teacher_id', $teacher->id)
                ->get();
        }

        return view('teacher.assigned_classes', compact('assignments'));
    }

    public function classSchedule()
    {
        $teacher = $this->getTeacher();
        $schedules = collect();
        
        if ($teacher) {
            $schedules = ClassroomAllocation::with(['course', 'room', 'semester'])
                ->whereHas('course', function($query) use ($teacher) {
                    $query->whereHas('courseAssignments', function($q) use ($teacher) {
                        $q->where('teacher_id', $teacher->id);
                    });
                })
                ->get();
        }

        return view('teacher.class_schedule', compact('schedules'));
    }

    public function saveResults()
    {
        $teacher = $this->getTeacher();
        $semesters = Semester::all();
        $assignedCourses = collect();
        
        if ($teacher) {
            $assignedCourses = CourseAssignment::with(['course', 'department'])
                ->where('teacher_id', $teacher->id)
                ->get();
        }

        return view('teacher.save_results', compact('semesters', 'assignedCourses'));
    }

    public function getCourseStudents(Request $request)
    {
        $courseId = $request->course_id;
        $semesterId = $request->semester_id;
        
        $enrollments = CourseEnrollment::with(['student', 'student.department'])
            ->where('course_id', $courseId)
            ->where('semester_id', $semesterId)
            ->where('status', 'Approved')
            ->get();

        $results = Result::where('course_id', $courseId)
            ->where('semester_id', $semesterId)
            ->get()
            ->keyBy('student_id');

        return response()->json([
            'enrollments' => $enrollments,
            'results' => $results
        ]);
    }

    public function saveStudentResults(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'semester_id' => 'required|exists:semesters,id',
            'results' => 'required|array',
            'results.*.student_id' => 'required|exists:students,id',
            'results.*.marks' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($validated['results'] as $resultData) {
            $marks = $resultData['marks'];
            $grade = $this->calculateGrade($marks);
            $gradePoint = $this->calculateGradePoint($marks);

            Result::updateOrCreate(
                [
                    'student_id' => $resultData['student_id'],
                    'course_id' => $validated['course_id'],
                    'semester_id' => $validated['semester_id'],
                ],
                [
                    'marks' => $marks,
                    'letter_grade' => $grade,
                    'grade_point' => $gradePoint,
                ]
            );
        }

        return redirect()->route('teacher.save-results')->with('success', 'Results saved successfully!');
    }

    private function calculateGrade($marks)
    {
        if ($marks >= 90) return 'A+';
        if ($marks >= 80) return 'A';
        if ($marks >= 70) return 'B';
        if ($marks >= 60) return 'C';
        if ($marks >= 50) return 'D';
        return 'F';
    }

    private function calculateGradePoint($marks)
    {
        if ($marks >= 90) return 4.00;
        if ($marks >= 80) return 3.75;
        if ($marks >= 70) return 3.50;
        if ($marks >= 60) return 3.25;
        if ($marks >= 50) return 3.00;
        return 0.00;
    }

    public function profile()
    {
        $user = Auth::user();
        $teacher = $this->getTeacher();
        return view('teacher.profile', compact('user', 'teacher'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $teacher = $this->getTeacher();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'teacher_name' => ['nullable', 'string', 'max:255'],
            'contact_no' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'designation' => ['nullable', 'string', 'max:100'],
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        if ($teacher) {
            $teacher->update([
                'teacher_name' => $validated['teacher_name'] ?? $teacher->teacher_name,
                'contact_no' => $validated['contact_no'] ?? $teacher->contact_no,
                'address' => $validated['address'] ?? $teacher->address,
                'designation' => $validated['designation'] ?? $teacher->designation,
            ]);
        }

        return redirect()->route('teacher.profile')->with('success', 'Profile updated successfully!');
    }
}


