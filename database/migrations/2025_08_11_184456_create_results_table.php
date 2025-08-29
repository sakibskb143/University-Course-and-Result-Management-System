<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('enrollment_id')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->decimal('marks', 5, 2)->default(0);
            $table->string('letter_grade', 4)->nullable();
            $table->decimal('grade_point', 3, 2)->nullable();
            $table->timestamps();

            $table->foreign('enrollment_id')->references('id')->on('course_enrollments')->onDelete('set null');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            // optional: one result per student-course (per exam flow)
            $table->unique(['student_id','course_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('results');
    }
};