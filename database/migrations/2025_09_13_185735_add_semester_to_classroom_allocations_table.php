<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('classroom_allocations', function (Blueprint $table) {
            if (!Schema::hasColumn('classroom_allocations', 'semester_id')) {
                $table->unsignedInteger('semester_id')->nullable()->after('course_id');
                $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classroom_allocations', function (Blueprint $table) {
            if (Schema::hasColumn('classroom_allocations', 'semester_id')) {
                $table->dropForeign(['semester_id']);
                $table->dropColumn('semester_id');
            }
        });
    }
};
