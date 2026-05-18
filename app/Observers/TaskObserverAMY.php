<?php

namespace App\Observers;

use App\Models\TaskXYZ;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class TaskObserverXYZ
{
    /** Called after a task is created */
    public function created(TaskXYZ $task): void
    {
        ActivityLog::create([
            'action'       => 'task.created',
            'subject_id'   => $task->id,
            'subject_type' => TaskXYZ::class,
            'user_id'      => Auth::id(),
            'new_values'   => $task->toArray(),
        ]);
    }

    /** Called after a task is updated */
    public function updated(TaskXYZ $task): void
    {
        ActivityLog::create([
            'action'       => 'task.updated',
            'subject_id'   => $task->id,
            'subject_type' => TaskXYZ::class,
            'user_id'      => Auth::id(),
            'old_values'   => $task->getOriginal(),
            'new_values'   => $task->getChanges(),
        ]);
    }

    /** Called after soft-delete */
    public function deleted(TaskXYZ $task): void
    {
        ActivityLog::create([
            'action'       => 'task.deleted',
            'subject_id'   => $task->id,
            'subject_type' => TaskXYZ::class,
            'user_id'      => Auth::id(),
        ]);
    }
}
