<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;

class TaskDueSoonNotification extends Notification
{
    use Queueable;

    public function __construct(protected Task $task) {}

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $task = $this->task;
        $habit = $task->habit;

        return (new MailMessage)
            ->subject("Reminder: \"{$task->body}\" due soon")
            ->greeting("Hi {$notifiable->name},")
            ->line("The task \"{$task->body}\" for habit \"{$habit->title}\" is due at {$task->due_at->format('M j, Y H:i')}.")
            ->action('View habit', route('habits.show', $habit->id))
            ->line('This is an automated reminder.');
    }

    public function toArray($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'habit_id' => $this->task->habit_id,
            'body' => $this->task->body,
            'due_at' => $this->task->due_at ? $this->task->due_at->toDateTimeString() : null,
        ];
    }
}
