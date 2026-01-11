<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dateTime('due_at')->nullable()->after('body');
        });

        // if a time column exists, migrate its values into due_at (use today's date)
        if (Schema::hasColumn('tasks', 'time')) {
            // This will set due_at to CURRENT_DATE + time value for rows where time is not null
            // Works on MySQL. For other DBs, adjust as needed.
            DB::statement("UPDATE `tasks` SET `due_at` = CONCAT(CURDATE(), ' ', `time`) WHERE `time` IS NOT NULL;");

            // drop the old time column
            Schema::table('tasks', function (Blueprint $table) {
                $table->dropColumn('time');
            });
        }
    }

    public function down()
    {
        // recreate time column and populate from due_at (time part), then drop due_at
        Schema::table('tasks', function (Blueprint $table) {
            $table->time('time')->nullable()->after('body');
        });

        if (Schema::hasColumn('tasks', 'due_at')) {
            // Extract time portion from due_at
            DB::statement("UPDATE `tasks` SET `time` = TIME(`due_at`) WHERE `due_at` IS NOT NULL;");

            Schema::table('tasks', function (Blueprint $table) {
                $table->dropColumn('due_at');
            });
        }
    }
};
