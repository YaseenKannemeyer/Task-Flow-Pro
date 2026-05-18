<?php

// =============================================================================
// FILE: app/Services/TaskServiceAMY.php
// Business logic isolated from the controller
// =============================================================================
namespace App\Services;

use App\Models\TaskAMY;
use App\Models\User;
use App\Notifications\TaskAssignedNotificationAMY;
use Illuminate\Support\Facades\Notification;

class TaskServiceAMY
{
    public function createTask(array $data, User $creator): TaskAMY
    {
        $data['created_by'] = $creator->id;
        $task = TaskAMY::create($data);

        // Notify the assignee (if different from creator)
        if ($task->assigned_to && $task->assigned_to !== $creator->id) {
            $task->assignee->notify(new TaskAssignedNotificationAMY($task));
        }

        return $task;
    }

    public function updateTask(TaskAMY $task, array $data): TaskAMY
    {
        $oldAssignee = $task->assigned_to;
        $task->update($data);

        // Notify new assignee if changed
        if (
            isset($data['assigned_to']) &&
            $data['assigned_to'] !== $oldAssignee &&
            $task->assignee
        ) {
            $task->assignee->notify(new TaskAssignedNotificationAMY($task));
        }

        return $task->fresh();
    }

    public function assignTask(TaskAMY $task, ?int $userId): TaskAMY
    {
        $task->update(['assigned_to' => $userId]);

        if ($userId && $task->assignee) {
            $task->assignee->notify(new TaskAssignedNotificationAMY($task));
        }

        return $task->fresh();
    }
}
