<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->enum('exam_type', ['Regular','Recourse','Retake'])->default('Regular');
            $table->enum('status', ['Pending','Approved'])->default('Pending');
            $table->decimal('course_fee', 10, 2)->nullable(); // fill from logic: course.credit * 2100
            $table->decimal('total_cost', 10, 2)->nullable();
            $table->unsignedInteger('semester_id');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('restrict');

            // a student shouldn't request the same course+exam_type twice for the same semester
            $table->unique(['student_id','course_id','exam_type','semester_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('course_enrollments');
    }
};
