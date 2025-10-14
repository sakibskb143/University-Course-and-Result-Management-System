<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'exam_type',
        'status',
        'course_fee',
        'total_cost',
        'semester_id'
    ];

    protected $casts = [
        'course_fee' => 'decimal:2',
        'total_cost' => 'decimal:2'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'enrollment_id');
    }
}
