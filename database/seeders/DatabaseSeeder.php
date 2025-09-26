<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!User::where('username', 'admin001')->exists()) {
            User::create([
                'username' => 'admin001',
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => 'password',
            ]);
        }

        if (!User::where('username', 'teacher001')->exists()) {
            User::create([
                'username' => 'teacher001',
                'name' => 'Test Teacher',
                'email' => 'teacher@example.com',
                'role' => 'teacher',
                'password' => 'password',
            ]);
        }

        if (!User::where('username', 'student001')->exists()) {
            User::create([
                'username' => 'student001',
                'name' => 'Test Student',
                'email' => 'student@example.com',
                'role' => 'student',
                'password' => 'password',
            ]);
        }

        $this->call([
            StudentSeeder::class,
        ]);
    }
}
