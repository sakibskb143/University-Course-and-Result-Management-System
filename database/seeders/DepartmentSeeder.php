<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['code' => 'CSE', 'name' => 'Computer Science & Engineering'],
            ['code' => 'EEE', 'name' => 'Electrical & Electronic Engineering'],
            ['code' => 'CE', 'name' => 'Civil Engineering'],
            ['code' => 'ME', 'name' => 'Mechanical Engineering'],
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate([
                'department_code' => $dept['code'],
            ], [
                'department_name' => $dept['name'],
            ]);
        }
    }
}


