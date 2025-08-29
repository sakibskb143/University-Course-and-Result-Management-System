<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');

            // optional link to users table for login credentials assigned by admin
            $table->unsignedBigInteger('user_id')->nullable()->unique();

            $table->string('student_reg_no')->unique(); // this is the roll/student id used to login
            $table->string('student_name');
            $table->string('email')->nullable()->unique();
            $table->string('contact_no', 20)->nullable();
            $table->text('address')->nullable();
            $table->year('year')->nullable(); // joining year or session
            $table->unsignedBigInteger('department_id');
            $table->unsignedTinyInteger('semester')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('students');
    }
};
