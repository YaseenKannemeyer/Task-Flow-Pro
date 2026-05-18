<?php

namespace App\Observers;

use App\Models\TaskAMY;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class TaskObserverAMY
{
    /** Called after a task is created */
    public function created(TaskAMY $task): void
    {
        ActivityLog::create([
            'action'       => 'task.created',
            'subject_id'   => $task->id,
            'subject_type' => TaskAMY::class,
            'user_id'      => Auth::id(),
            'new_values'   => $task->toArray(),
        ]);
    }

    /** Called after a task is updated */
    public function updated(TaskAMY $task): void
    {
        ActivityLog::create([
            'action'       => 'task.updated',
            'subject_id'   => $task->id,
            'subject_type' => TaskAMY::class,
            'user_id'      => Auth::id(),
            'old_values'   => $task->getOriginal(),
            'new_values'   => $task->getChanges(),
        ]);
    }

    /** Called after soft-delete */
    public function deleted(TaskAMY $task): void
    {
        ActivityLog::create([
            'action'       => 'task.deleted',
            'subject_id'   => $task->id,
            'subject_type' => TaskAMY::class,
            'user_id'      => Auth::id(),
        ]);
    }
}
