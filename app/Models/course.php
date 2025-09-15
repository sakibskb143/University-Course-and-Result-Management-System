<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'department_id',
        'semester_id', 
        'course_code',
        'course_name', 
        'credit'
    ];

    // Define relationship to CourseEnrollment
    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    // Define relationship to Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Static method to get expanded sample data
    public static function all($columns = ['*'])
    {
        return collect([
            (object)[
                'id' => 1,
                'course_code' => 'CSE301',
                'course_name' => 'Operating Systems',
                'credit' => 3.0
            ],
            (object)[
                'id' => 2,
                'course_code' => 'CSE302',
                'course_name' => 'Database Management Systems',
                'credit' => 3.0
            ],
            (object)[
                'id' => 3,
                'course_code' => 'CSE303',
                'course_name' => 'Computer Networks',
                'credit' => 3.0
            ],
            (object)[
                'id' => 4,
                'course_code' => 'CSE304',
                'course_name' => 'Software Engineering',
                'credit' => 3.0
            ],
            (object)[
                'id' => 5,
                'course_code' => 'CSE305',
                'course_name' => 'Algorithm Design and Analysis',
                'credit' => 3.0
            ],
            (object)[
                'id' => 6,
                'course_code' => 'CSE306',
                'course_name' => 'Artificial Intelligence',
                'credit' => 3.0
            ],
            (object)[
                'id' => 7,
                'course_code' => 'CSE307',
                'course_name' => 'Machine Learning',
                'credit' => 3.0
            ],
            (object)[
                'id' => 8,
                'course_code' => 'CSE308',
                'course_name' => 'Web Development',
                'credit' => 2.0
            ],
            (object)[
                'id' => 9,
                'course_code' => 'CSE309',
                'course_name' => 'Mobile App Development',
                'credit' => 2.0
            ],
            (object)[
                'id' => 10,
                'course_code' => 'MAT201',
                'course_name' => 'Linear Algebra',
                'credit' => 3.0
            ],
            (object)[
                'id' => 11,
                'course_code' => 'MAT202',
                'course_name' => 'Discrete Mathematics',
                'credit' => 3.0
            ],
            (object)[
                'id' => 12,
                'course_code' => 'MAT203',
                'course_name' => 'Statistics and Probability',
                'credit' => 3.0
            ],
            (object)[
                'id' => 13,
                'course_code' => 'PHY101',
                'course_name' => 'Physics I',
                'credit' => 3.0
            ],
            (object)[
                'id' => 14,
                'course_code' => 'PHY102',
                'course_name' => 'Physics II',
                'credit' => 3.0
            ],
            (object)[
                'id' => 15,
                'course_code' => 'ENG101',
                'course_name' => 'English Composition',
                'credit' => 2.0
            ],
            (object)[
                'id' => 16,
                'course_code' => 'ENG102',
                'course_name' => 'Technical Writing',
                'credit' => 2.0
            ],
            (object)[
                'id' => 17,
                'course_code' => 'CSE401',
                'course_name' => 'Computer Graphics',
                'credit' => 3.0
            ],
            (object)[
                'id' => 18,
                'course_code' => 'CSE402',
                'course_name' => 'Data Mining',
                'credit' => 3.0
            ],
            (object)[
                'id' => 19,
                'course_code' => 'CSE403',
                'course_name' => 'Cybersecurity',
                'credit' => 3.0
            ],
            (object)[
                'id' => 20,
                'course_code' => 'CSE404',
                'course_name' => 'Cloud Computing',
                'credit' => 3.0
            ]
        ]);
    }

    // Add findOrFail method for compatibility
    public static function findOrFail($id)
    {
        $courses = self::all();
        $course = $courses->firstWhere('id', $id);
        
        if (!$course) {
            throw new \Exception("Course not found");
        }
        
        return $course;
    }

    // Add find method
    public static function find($id)
    {
        $courses = self::all();
        return $courses->firstWhere('id', $id);
    }
}