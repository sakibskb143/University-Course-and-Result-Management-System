<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseEnrollment;

class EnrollmentController extends Controller
{
    /**
     * Show the course enrollment page with available and enrolled courses.
     */
    public function showEnrollment()
    {
        // Using a mock student ID. In a real app, you would use auth()->id()
        $studentId = 1; 

        $courses = Course::all();
        
        // This will now work correctly after you remove the 'with()' function
        // Your custom get() method in the model handles the rest
        $enrolledCourses = CourseEnrollment::where('student_id', $studentId)
                                           ->latest()
                                           ->get();

        return view('student.enroll.course_enrollment', compact('courses', 'enrolledCourses'));
    }

    /**
     * Handle the course enrollment form submission.
     */
    public function enrollCourse(Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer',
            'exam_type' => 'required|string',
        ]);
        
        // Using a mock student ID.
        $studentId = 1;

        // Use the check method you already created
        if (CourseEnrollment::isAlreadyEnrolled($studentId, $request->course_id, $request->exam_type)) {
            return redirect()->route('student.enroll')->with('error', 'You are already enrolled in this course for this exam type!');
        }

        $course = Course::findOrFail($request->course_id);

        // Calculate course fee based on credit
        $fee = $course->credit * 2100;

        // Use your mock 'create' method to simulate saving the enrollment
        CourseEnrollment::create([
            'student_id' => $studentId,
            'course_id' => $request->course_id,
            'exam_type' => $request->exam_type,
            'status' => 'Pending', // Default status
            'course_fee' => $fee,
            'total_cost' => $fee,
        ]);

        return redirect()->route('student.enroll')->with('success', 'Successfully requested enrollment for ' . $course->course_name . '!');
    }

    // You can add other methods like showMyEnrollments, showResults, etc. here
    public function showMyEnrollments()
    {
        // Add logic for this page later
        return "Page for 'My Enrollments'";
    }
    
    public function showResults()
    {
        // Add logic for this page later
        return "Page for 'Results'";
    }

    public function showSchedule()
    {
        // Add logic for this page later
        return "Page for 'Schedule'";
    }
}