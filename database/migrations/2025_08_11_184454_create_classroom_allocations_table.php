<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('classroom_allocations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('room_id');
            $table->enum('day', ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday']);
            $table->time('time_from');
            $table->time('time_to');
            $table->tinyInteger('status')->default(1); // 1 = active, 0 = inactive
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

            // optional: avoid same room conflict for same day/time
            $table->index(['room_id', 'day', 'time_from', 'time_to']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('classroom_allocations');
    }
};







