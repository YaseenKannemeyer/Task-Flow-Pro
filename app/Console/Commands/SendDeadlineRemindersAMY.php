<?php

namespace App\Console\Commands;

use App\Mail\DeadlineReminderMailAMY;
use App\Models\TaskAMY;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDeadlineRemindersAMY extends Command
{
    protected $signature   = 'reminders:send-deadlines';
    protected $description = 'Send deadline reminder emails for tasks due tomorrow';

    public function handle(): void
    {
        $tasks = TaskAMY::pendingReminder()
                        ->with('assignee')
                        ->get();

        $count = 0;

        foreach ($tasks as $task) {
            if ($task->assignee && $task->assignee->is_active) {
                Mail::to($task->assignee->email)
                    ->queue(new DeadlineReminderMailAMY($task, $task->assignee));

                $task->update(['reminder_sent' => true]);
                $count++;
            }
        }

        $this->info("Sent {$count} deadline reminders.");
    }
}
