<?php

namespace App\Notifications;

use App\Models\TaskAMY;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignedNotificationAMY extends Notification
{
    use Queueable;

    public function __construct(public TaskAMY $task) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("You've been assigned: {$this->task->title}")
            ->greeting("Hello {$notifiable->name}!")
            ->line("A task has been assigned to you.")
            ->line("**Task:** {$this->task->title}")
            ->line("**Priority:** {$this->task->priority_label}")
            ->line("**Due Date:** " . ($this->task->due_date?->format('d M Y') ?? 'No deadline'))
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Thank you for using Task Manager!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'task_id'    => $this->task->id,
            'task_title' => $this->task->title,
            'message'    => "You have been assigned the task: {$this->task->title}",
        ];
    }
}