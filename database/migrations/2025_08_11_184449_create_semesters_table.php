<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('semesters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('semester_name'); // e.g. "Semester 1" or "1"
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('semesters');
    }
};