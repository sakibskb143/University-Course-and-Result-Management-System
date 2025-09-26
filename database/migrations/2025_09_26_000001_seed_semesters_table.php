<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Seed semesters 1..8 if not present
        for ($i = 1; $i <= 8; $i++) {
            $name = (string) $i;
            $exists = DB::table('semesters')->where('semester_name', $name)->exists();
            if (!$exists) {
                DB::table('semesters')->insert([
                    'semester_name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        // no-op: keep seed data
    }
};


