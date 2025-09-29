<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassroomAllocation;
use App\Models\Course;
use App\Models\Department;
use App\Models\Room;
use App\Models\Semester;

class ClassroomAllocationSeeder extends Seeder
{
    public function run(): void
    {
        $department = Department::first();
        $rooms = Room::all();
        $semesters = Semester::all();
        if (!$department || $rooms->isEmpty() || $semesters->isEmpty()) { return; }

        $courses = Course::where('department_id', $department->id)->get();
        if ($courses->isEmpty()) { return; }

        $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];
        $timeSlots = [
            ['from' => '09:00', 'to' => '10:30'],
            ['from' => '10:30', 'to' => '12:00'],
            ['from' => '12:00', 'to' => '13:30'],
            ['from' => '14:00', 'to' => '15:30'],
        ];

        foreach ($semesters as $semester) {
            $semesterCourses = $courses->where('semester_id', $semester->id);
            foreach ($semesterCourses as $course) {
                foreach ($timeSlots as $slot) {
                    $day = $days[array_rand($days)];
                    $room = $rooms->random();
                    ClassroomAllocation::firstOrCreate([
                        'department_id' => $department->id,
                        'course_id' => $course->id,
                        'semester_id' => $semester->id,
                        'room_id' => $room->id,
                        'day' => $day,
                        'time_from' => $slot['from'],
                        'time_to' => $slot['to'],
                    ], [
                        'status' => 1,
                    ]);
                }
            }
        }
    }
}


