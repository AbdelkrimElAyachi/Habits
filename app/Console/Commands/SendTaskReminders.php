<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Task;
use App\Notifications\TaskReminderNotification; // Check for typos here!
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SendTaskReminders extends Command
{
    protected $signature = 'tasks:send-reminders {--minutes=60 : Lookahead window in minutes}';
    protected $description = 'Send reminders for tasks that are due soon';

    
    public function handle()
    {
        // Find your admin or a dedicated system user
        $admin = User::where('email', 'system@habit.com')->first();
        $window = (int) $this->option('minutes') ?: 60;

        // app timezone now/until (for logging / PHP-side comparison)
        $nowApp = now();
        $untilApp = now()->addMinutes($window);

        $this->info('App timezone: ' . config('app.timezone'));
        $this->info('App window: ' . $nowApp->toDateTimeString() . ' -> ' . $untilApp->toDateTimeString());

        // To avoid DB timezone mismatches we fetch a broader range from DB then filter in PHP.
        // Fetch tasks due roughly within yesterday..tomorrow to keep dataset small but safe.
        $fromDbString = $nowApp->toDateTimeString();
        $toDbString = $untilApp->toDateTimeString();

        $this->info("Querying DB for tasks with due_at between {$fromDbString} and {$toDbString} (broad window).");

        $tasks = Task::with(['habit.user', 'activities'])
            ->where('is_complete', false)
            ->whereNotNull('due_at')
            ->whereBetween('due_at', [$fromDbString, $toDbString])
            ->get();

        $this->info('Found ' . $tasks->count() . ' candidate task(s) from DB; applying precise app-time window check.');

        foreach ($tasks as $task) {
            // Set the acting user for this process
            auth()->login($admin);

            // raw DB value for debugging
            $raw = $task->getAttributes()['due_at'] ?? null;
            $this->line("Task {$task->id} raw due_at: " . ($raw ?? 'null') . " -> cast: " . ($task->due_at ? $task->due_at->toDateTimeString() : 'null'));

            // ensure we have a Carbon instance and check between in app timezone
            if (! $task->due_at) {
                $this->line(" - task {$task->id} has no casted due_at, skipping.");
                continue;
            }

            if (! $task->due_at->between($nowApp, $untilApp)) {
                $this->line(" - task {$task->id} is outside the app window, skipping.");
                continue;
            }

            $user = $task->habit->user ?? null;
            if (! $user) {
                $this->line(" - task {$task->id} has no owner, skipping.");
                continue;
            }

            // Skip if we've already sent a reminder (activity recorded)
            $already = $task->activities()->where('description', 'reminder_sent')->exists();
            if ($already) {
                $this->line(" - task {$task->id} already reminded, skipping.");
                continue;
            }

            try {
                $user->notify(new TaskReminderNotification($task));
                $task->trackActivity('reminder_sent');
                $this->line(" - notified user {$user->id} for task {$task->id}");
            } catch (\Throwable $e) {
                $this->error(" - failed to notify for task {$task->id}: ".$e->getMessage());
            }
        }

        return 0;
    }
    

}