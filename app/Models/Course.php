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
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
