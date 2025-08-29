<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('department_code', 7)->unique();
            $table->string('department_name');
            $table->timestamps();
        });

        // Optional DB-level check (MySQL 8+). App-level validation is still required.
        DB::statement("ALTER TABLE departments ADD CONSTRAINT chk_department_code_len CHECK (CHAR_LENGTH(department_code) BETWEEN 2 AND 7)");
    }

    public function down(): void {
        Schema::dropIfExists('departments');
    }
};