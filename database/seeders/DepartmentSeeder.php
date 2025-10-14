<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        if (Department::count() === 0) {
            $departments = [
                [
                    'department_code' => 'CSE',
                    'department_name' => 'Computer Science and Engineering',
                ],
                [
                    'department_code' => 'EEE',
                    'department_name' => 'Electrical and Electronic Engineering',
                ],
                [
                    'department_code' => 'ME',
                    'department_name' => 'Mechanical Engineering',
                ],
                [
                    'department_code' => 'CE',
                    'department_name' => 'Civil Engineering',
                ],
                [
                    'department_code' => 'IPE',
                    'department_name' => 'Industrial and Production Engineering',
                ],
            ];

            foreach ($departments as $department) {
                Department::create($department);
            }
        }
    }
}
