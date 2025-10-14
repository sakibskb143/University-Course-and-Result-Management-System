<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester_name',
        'semester_code',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function classroomAllocations()
    {
        return $this->hasMany(ClassroomAllocation::class);
    }
}
