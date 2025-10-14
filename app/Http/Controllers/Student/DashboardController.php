<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\CourseEnrollment;
use App\Models\ClassroomAllocation;
use App\Models\Result;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    private function resolveAuthenticatedStudent(): ?Student
    {
        $user = Auth::user();
        if (!$user) {
            return null;
        }

        $student = $user->student;
        if ($student instanceof Student) {
            return $student;
        }

        // Attempt to find by direct link or common identifiers
        $student = Student::query()
            ->where('user_id', $user->id)
            ->orWhere('student_reg_no', $user->username)
            ->orWhere('email', $user->email)
            ->first();

        if ($student instanceof Student) {
            // Auto-link to user for subsequent requests
            if ($student->user_id === null) {
                $student->user_id = $user->id;
                $student->save();
            }
            return $student;
        }

        return null;
    }
    public function index()
    {
        $student = $this->resolveAuthenticatedStudent();
        
        if (!$student) {
            \Log::warning('Student dashboard access without profile', [
                'user_id' => Auth::id(),
                'route' => 'student.dashboard',
            ]);
            return redirect()->route('student.login')->with('error', 'Student profile not found.');
        }

        // Get dashboard statistics
        $enrolledCourses = CourseEnrollment::where('student_id', $student->id)
            ->where('status', 'enrolled')
            ->count();
            
        $completedCourses = CourseEnrollment::where('student_id', $student->id)
            ->where('status', 'completed')
            ->count();
            
        $currentSemester = Semester::where('is_current', true)->first();
        $currentSemesterEnrollments = 0;
        
        if ($currentSemester) {
            $currentSemesterEnrollments = CourseEnrollment::where('student_id', $student->id)
                ->where('semester_id', $currentSemester->id)
                ->where('status', 'enrolled')
                ->count();
        }

        return view('student.student_dashboard', compact('enrolledCourses', 'completedCourses', 'currentSemesterEnrollments'));
    }

    public function profile()
    {
        $student = $this->resolveAuthenticatedStudent();
        
        if (!$student) {
            \Log::warning('Student profile view without profile', [
                'user_id' => Auth::id(),
                'route' => 'student.profile',
            ]);
            return redirect()->route('student.login')->with('error', 'Student profile not found.');
        }

        return view('student.profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $student = $this->resolveAuthenticatedStudent();
        
        if (!$student) {
            \Log::warning('Student class schedule access without profile', [
                'user_id' => Auth::id(),
                'route' => 'student.class-schedule',
            ]);
            return redirect()->route('student.login')->with('error', 'Student profile not found.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'contact_no' => 'required|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update user information
        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update student information
        $student->update([
            'student_name' => $request->name,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            if ($student->user->profile_image && Storage::disk('public')->exists($student->user->profile_image)) {
                Storage::disk('public')->delete($student->user->profile_image);
            }

            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('profile_images', $imageName, 'public');
            
            Auth::user()->update(['profile_image' => $imagePath]);
        }

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }

    public function classSchedule()
    {
        $student = $this->resolveAuthenticatedStudent();
        
        if (!$student) {
            \Log::warning('Student enroll access without profile', [
                'user_id' => Auth::id(),
                'route' => 'student.enroll-courses',
            ]);
            return redirect()->route('student.login')->with('error', 'Student profile not found.');
        }

        // Get current semester
        $currentSemester = Semester::where('is_current', true)->first();
        
        if (!$currentSemester) {
            return view('student.class_schedule', compact('student'))
                ->with('message', 'No current semester found.');
        }

        // Get enrolled courses for current semester
        $enrolledCourses = CourseEnrollment::where('student_id', $student->id)
            ->where('semester_id', $currentSemester->id)
            ->where('status', 'enrolled')
            ->with(['course', 'course.teacher'])
            ->get();

        // Get class schedules for enrolled courses
        $classSchedules = [];
        foreach ($enrolledCourses as $enrollment) {
            $schedules = ClassroomAllocation::where('course_id', $enrollment->course_id)
                ->where('semester_id', $currentSemester->id)
                ->with(['room', 'course'])
                ->get();
            
            foreach ($schedules as $schedule) {
                $classSchedules[] = [
                    'course' => $schedule->course,
                    'teacher' => $enrollment->course->teacher,
                    'room' => $schedule->room,
                    'day' => $schedule->day,
                    'start_time' => $schedule->start_time,
                    'end_time' => $schedule->end_time,
                ];
            }
        }

        return view('student.class_schedule', compact('student', 'classSchedules', 'currentSemester'));
    }

    public function enrollCourses()
    {
        $student = $this->resolveAuthenticatedStudent();
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'Student profile not found.');
        }

        // Get current semester
        $currentSemester = Semester::where('is_current', true)->first();
        
        if (!$currentSemester) {
            return redirect()->route('student.dashboard')
                ->with('error', 'No current semester found. Course enrollment is not available.');
        }

        // Get available courses for student's department in current semester
        $availableCourses = Course::where('department_id', $student->department_id)
            ->where('semester_id', $currentSemester->id)
            ->where('status', 'active')
            ->with(['teacher', 'department'])
            ->get();

        // Get already enrolled courses
        $enrolledCourseIds = CourseEnrollment::where('student_id', $student->id)
            ->where('semester_id', $currentSemester->id)
            ->where('status', 'enrolled')
            ->pluck('course_id')
            ->toArray();

        return view('student.enroll_courses', compact('student', 'availableCourses', 'enrolledCourseIds', 'currentSemester'));
    }

    public function enrollInCourse(Request $request)
    {
        $student = Auth::user()->student;
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'Student profile not found.');
        }

        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get current semester
        $currentSemester = Semester::where('is_current', true)->first();
        
        if (!$currentSemester) {
            return redirect()->back()->with('error', 'No current semester found.');
        }

        // Check if already enrolled
        $existingEnrollment = CourseEnrollment::where('student_id', $student->id)
            ->where('course_id', $request->course_id)
            ->where('semester_id', $currentSemester->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Get course details
        $course = Course::findOrFail($request->course_id);

        // Create enrollment
        CourseEnrollment::create([
            'student_id' => $student->id,
            'course_id' => $request->course_id,
            'semester_id' => $currentSemester->id,
            'exam_type' => 'regular',
            'status' => 'enrolled',
            'course_fee' => $course->course_fee ?? 0,
            'total_cost' => $course->course_fee ?? 0,
        ]);

        return redirect()->route('student.enroll-courses')->with('success', 'Successfully enrolled in the course.');
    }

    public function viewResults()
    {
        $student = Auth::user()->student;
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'Student profile not found.');
        }

        // Get published results for the student
        $results = Result::where('student_id', $student->id)
            ->where('published', true)
            ->with(['course', 'semester'])
            ->orderBy('semester_id', 'desc')
            ->orderBy('course_id', 'asc')
            ->get();

        // Group results by semester
        $resultsBySemester = $results->groupBy('semester.name');

        // Calculate GPA for each semester
        $semesterGPAs = [];
        foreach ($resultsBySemester as $semesterName => $semesterResults) {
            $totalPoints = 0;
            $totalCredits = 0;
            
            foreach ($semesterResults as $result) {
                $totalPoints += $result->grade_point * ($result->course->credit_hours ?? 3);
                $totalCredits += $result->course->credit_hours ?? 3;
            }
            
            $semesterGPAs[$semesterName] = $totalCredits > 0 ? $totalPoints / $totalCredits : 0;
        }

        return view('student.view_results', compact('student', 'resultsBySemester', 'semesterGPAs'));
    }
}