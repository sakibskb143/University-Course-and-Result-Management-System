<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        static $reg = 1000; // auto-incrementing student_reg_no

        return [
            'user_id'        => null, // optional, leave null for now
            'student_reg_no' => 'REG-' . $reg++, // unique reg no like REG-1000, REG-1001
            'student_name'   => $this->faker->name(),
            'email'          => $this->faker->unique()->safeEmail(),
            'contact_no'     => $this->faker->phoneNumber(),
            'address'        => $this->faker->address(),
            'year'           => $this->faker->year($max = '2025'),
            'department_id'  => $this->faker->numberBetween(1, 5), // assuming you have 5 departments
            'semester'       => $this->faker->numberBetween(1, 8), // semesters 1–8
        ];
    }
}
