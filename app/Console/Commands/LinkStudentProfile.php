<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Student;

class LinkStudentProfile extends Command
{
    protected $signature = 'student:link-profile';
    protected $description = 'Link student user to student profile with department and semester';

    public function handle()
    {
        $user = User::where('role', 'student')->first();
        if (!$user) {
            $this->error('No student user found');
            return;
        }

        $student = Student::where('user_id', $user->id)->first();
        if (!$student) {
            $student = new Student();
            $student->user_id = $user->id;
            $student->student_reg_no = 'REG-' . $user->id;
            $student->student_name = $user->name;
            $student->email = $user->email;
            $student->contact_no = '0123456789';
            $student->address = 'N/A';
            $student->year = date('Y');
            $student->department_id = 1;
            $student->semester = 1;
            $student->save();
            $this->info('Created student profile for user: ' . $user->name);
        } else {
            $student->department_id = 1;
            $student->semester = 1;
            $student->save();
            $this->info('Updated student profile for user: ' . $user->name);
        }
    }
}
