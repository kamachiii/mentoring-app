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
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreignId('mentoring_group_id')
                ->nullable()
                ->constrained('mentoring_group', 'id')
                ->onDelete('set null')
                ->after('mentor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreignId('mentoring_group_id')
                ->nullable()
                ->constrained('mentoring_group', 'id')
                ->onDelete('set null')
                ->after('mentor_id');
        });
    }
};
