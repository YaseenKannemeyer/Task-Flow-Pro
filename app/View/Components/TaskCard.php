<?php

namespace App\View\Components;

use App\Models\TaskAMY;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskCard extends Component
{
    /**
     * The task model instance.
     */
    public TaskAMY $task;

    /**
     * Whether to show the assignee avatar row.
     */
    public bool $showAssignee;

    /**
     * Whether to show the action buttons (status update, edit, delete).
     */
    public bool $showActions;

    /**
     * Whether to show the category pill.
     */
    public bool $showCategory;

    /**
     * Create a new component instance.
     *
     * @param  TaskAMY  $task         The task to display.
     * @param  bool     $showAssignee Show assignee avatar. Default true.
     * @param  bool     $showActions  Show quick-action buttons. Default false.
     * @param  bool     $showCategory Show category pill. Default true.
     */
    public function __construct(
        TaskAMY $task,
        bool $showAssignee = true,
        bool $showActions  = false,
        bool $showCategory = true,
    ) {
        $this->task         = $task;
        $this->showAssignee = $showAssignee;
        $this->showActions  = $showActions;
        $this->showCategory = $showCategory;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task-card');
    }
}