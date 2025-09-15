<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseEnrollment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_id',
        'course_id',
        'exam_type',
        'status',
        'course_fee',
        'total_cost'
    ];

    protected $casts = [
        'course_fee' => 'decimal:2',
        'total_cost' => 'decimal:2',
    ];

    // Define relationship to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Define relationship to Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Check if student is already enrolled in a course
    public static function isAlreadyEnrolled($studentId, $courseId, $examType = null)
    {
        $query = static::where('student_id', $studentId)
                      ->where('course_id', $courseId);
        
        if ($examType) {
            $query->where('exam_type', $examType);
        }
        
        // For mock data, check our sample enrollments
        $enrollments = static::getSampleEnrollments($studentId);
        
        foreach ($enrollments as $enrollment) {
            if ($enrollment->course_id == $courseId && 
                ($examType === null || $enrollment->exam_type == $examType)) {
                return true;
            }
        }
        
        return false;
    }

    // Get sample enrollments for a student
    public static function getSampleEnrollments($studentId)
    {
        return collect([
            (object)[
                'id' => 1,
                'student_id' => 1,
                'course_id' => 1,
                'exam_type' => 'Regular',
                'status' => 'Approved',
                'course_fee' => 6300.00,
                'total_cost' => 6300.00,
                'created_at' => now()->subDays(10),
            ],
            (object)[
                'id' => 2,
                'student_id' => 1,
                'course_id' => 2,
                'exam_type' => 'Regular',
                'status' => 'Pending',
                'course_fee' => 6300.00,
                'total_cost' => 6300.00,
                'created_at' => now()->subDays(5),
            ]
        ])->where('student_id', $studentId);
    }

    // Static method for where queries (mock implementation)
    public static function where($column, $operator = null, $value = null)
    {
        $instance = new static();
        
        if (is_array($column)) {
            $instance->whereConditions = $column;
        } elseif ($value === null) {
            $instance->whereConditions = [$column => $operator];
        } else {
            $instance->whereConditions = [$column => $value];
        }
        
        return $instance;
    }

    protected $whereConditions = [];

    // Get method for mock data
    public function get()
    {
        $enrollments = collect();
        
        // Get sample data for all students
        for ($i = 1; $i <= 5; $i++) {
            $studentEnrollments = $this->getSampleEnrollments($i);
            $enrollments = $enrollments->merge($studentEnrollments);
        }

        // Apply where conditions
        if (!empty($this->whereConditions)) {
            foreach ($this->whereConditions as $column => $value) {
                $enrollments = $enrollments->where($column, $value);
            }
        }

        // Add course relationships
        $enrollments = $enrollments->map(function ($enrollment) {
            $course = Course::find($enrollment->course_id);
            $enrollment->course = $course;
            return $enrollment;
        });

        return $enrollments->values();
    }

    public function first()
    {
        $results = $this->get();
        return $results->first();
    }

    // Mock create method
    public static function create($data)
    {
        // Simulate database insertion
        $enrollment = (object) array_merge($data, [
            'id' => rand(100, 999),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // In a real app, this would save to database
        // For now, we'll just return the mock object
        return $enrollment;
    }

    // With method for eager loading (mock)
    
    // Latest method for ordering
    public function latest()
    {
        return $this;
    }
}