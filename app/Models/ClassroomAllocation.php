<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomAllocation extends Model
{
    use HasFactory;

  protected $fillable = [
    'department_id',
    'course_id',
    'semester_id',
    'room_id',
    'day',
    'time_from',
    'time_to',
    'status',
];


    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
