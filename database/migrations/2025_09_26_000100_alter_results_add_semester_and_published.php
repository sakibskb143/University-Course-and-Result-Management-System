<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('results', function (Blueprint $table) {
            if (!Schema::hasColumn('results', 'semester_id')) {
                $table->unsignedInteger('semester_id')->nullable()->after('grade_point');
                $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('set null');
            }
            if (!Schema::hasColumn('results', 'published')) {
                $table->boolean('published')->default(false)->after('semester_id');
            }
        });

        // Adjust unique constraint to include semester_id
        try {
            Schema::table('results', function (Blueprint $table) {
                $table->dropUnique('results_student_id_course_id_unique');
            });
        } catch (\Throwable $e) {
            // ignore if it doesn't exist
        }
        try {
            Schema::table('results', function (Blueprint $table) {
                $table->unique(['student_id','course_id','semester_id']);
            });
        } catch (\Throwable $e) {
            // ignore if it already exists
        }
    }

    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            if (Schema::hasColumn('results', 'published')) {
                $table->dropColumn('published');
            }
            if (Schema::hasColumn('results', 'semester_id')) {
                $table->dropForeign(['semester_id']);
                $table->dropColumn('semester_id');
            }
        });
    }
};


