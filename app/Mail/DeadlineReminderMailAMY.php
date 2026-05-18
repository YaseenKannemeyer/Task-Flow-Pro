<?php

namespace App\Mail;

use App\Models\TaskAMY;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeadlineReminderMailAMY extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public TaskAMY $task,
        public User    $recipient
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Reminder: Task '{$this->task->title}' is due tomorrow",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.deadline-reminder',
            with: [
                'task'      => $this->task,
                'recipient' => $this->recipient,
                'dueDate'   => $this->task->due_date->format('D, d M Y'),
            ],
        );
    }
}