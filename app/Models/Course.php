<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'semester_id',
        'course_code',
        'course_name',
        'credit',
        'credit_hours',
        'course_fee',
        'description',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function courseAssignments()
    {
        return $this->hasMany(CourseAssignment::class);
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function teacher()
    {
        return $this->hasOneThrough(
            Teacher::class,
            CourseAssignment::class,
            'course_id',
            'id',
            'id',
            'teacher_id'
        );
    }
}
