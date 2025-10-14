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
            $table->enum('exam_type', ['Regular', 'Recourse', 'Retake'])->default('Regular');
            $table->enum('status', ['Pending', 'Approved'])->default('Pending');
            $table->decimal('course_fee', 10, 2)->nullable(); // course.credit * 2100 logic
            $table->decimal('total_cost', 10, 2)->nullable();
            $table->unsignedInteger('semester_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('restrict');

            // Unique constraint with shorter name
            $table->unique(
                ['student_id', 'course_id', 'exam_type', 'semester_id'],
                'enrollment_unique'
            );
        });
    }

    public function down(): void {
        // Disable FK checks to avoid rollback errors
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('course_enrollments');
        Schema::enableForeignKeyConstraints();
    }
};
