<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('reminder_sent')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('tasks', 'due_at')) {
            // Extract time portion from due_at
            DB::statement("UPDATE `tasks` SET `time` = TIME(`due_at`) WHERE `due_at` IS NOT NULL;");

            Schema::table('tasks', function (Blueprint $table) {
                $table->dropColumn('due_at');
            });
        }

    }
};
