<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Department;
use App\Models\Semester;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $department = Department::first();
        if (!$department) { return; }

        $semesters = Semester::all();
        if ($semesters->isEmpty()) { return; }

        $courses = [
            ['code' => 'CSE101', 'name' => 'Programming Fundamentals', 'credit' => 3],
            ['code' => 'CSE102', 'name' => 'Data Structures', 'credit' => 3],
            ['code' => 'CSE103', 'name' => 'Database Systems', 'credit' => 3],
            ['code' => 'CSE201', 'name' => 'Object Oriented Programming', 'credit' => 3],
            ['code' => 'CSE202', 'name' => 'Computer Networks', 'credit' => 3],
            ['code' => 'CSE203', 'name' => 'Software Engineering', 'credit' => 3],
        ];

        foreach ($courses as $courseData) {
            foreach ($semesters as $semester) {
                Course::firstOrCreate([
                    'department_id' => $department->id,
                    'semester_id' => $semester->id,
                    'course_code' => $courseData['code'] . '_' . $semester->id,
                ], [
                    'course_name' => $courseData['name'],
                    'credit' => $courseData['credit'],
                ]);
            }
        }
    }
}


