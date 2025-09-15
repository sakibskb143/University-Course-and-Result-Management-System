<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'teacher_id',
        'course_id',
        'assigned_credit'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
