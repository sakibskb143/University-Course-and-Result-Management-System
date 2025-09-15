<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_reg_no',
        'student_name',
        'email',
        'contact_no',
        'address',
        'year',
        'department_id',
        'semester'
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
}