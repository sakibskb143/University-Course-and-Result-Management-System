<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_enrollments', function (Blueprint $table) {
            if (!Schema::hasColumn('course_enrollments', 'semester_id')) {
                $table->unsignedInteger('semester_id')->after('total_cost');
                $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('restrict');
            }
        });

        // Adjust unique to include semester_id
        try {
            Schema::table('course_enrollments', function (Blueprint $table) {
                $table->dropUnique('course_enrollments_student_id_course_id_exam_type_unique');
            });
        } catch (\Throwable $e) {
            // ignore if not exists
        }
        try {
            Schema::table('course_enrollments', function (Blueprint $table) {
                $table->unique(['student_id','course_id','exam_type','semester_id']);
            });
        } catch (\Throwable $e) {
            // ignore if already exists
        }
    }

    public function down(): void
    {
        Schema::table('course_enrollments', function (Blueprint $table) {
            if (Schema::hasColumn('course_enrollments', 'semester_id')) {
                $table->dropUnique(['student_id','course_id','exam_type','semester_id']);
                $table->dropForeign(['semester_id']);
                $table->dropColumn('semester_id');
            }
        });
    }
};


