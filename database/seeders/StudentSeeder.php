<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        if (Student::count() === 0) {
            Student::factory()->count(50)->create();
        }
    }
}
