<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedInteger('semester_id');
            $table->string('course_code')->unique();
            $table->string('course_name');
            $table->decimal('credit', 3, 1); // e.g. 0.5 - 5.0
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('restrict');
        });

        // DB checks (MySQL 8+). Keep app-level validation too.
        DB::statement("ALTER TABLE courses ADD CONSTRAINT chk_course_code_len CHECK (CHAR_LENGTH(course_code) >= 5)");
        DB::statement("ALTER TABLE courses ADD CONSTRAINT chk_credit_range CHECK (credit >= 0.5 AND credit <= 5.0)");
    }

    public function down(): void {
        Schema::dropIfExists('courses');
    }
};