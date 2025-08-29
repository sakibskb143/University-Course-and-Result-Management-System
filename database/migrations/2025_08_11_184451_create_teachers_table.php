<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');

            // optional link to users table for login credentials assigned by admin
            $table->unsignedBigInteger('user_id')->nullable()->unique();

            $table->unsignedBigInteger('department_id');
            $table->string('teacher_name');
            $table->text('address')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('contact_no', 20)->nullable();
            $table->string('designation')->nullable();
            $table->decimal('credit_to_be_taken', 5, 2)->default(0.00);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('teachers');
    }
};
