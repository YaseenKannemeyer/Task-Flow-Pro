<?php

// =============================================================================
// FILE: app/Http/Controllers/TaskControllerAMY.php
// Full resource controller with dependency injection
// =============================================================================
namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequestAMY;
use App\Http\Requests\UpdateTaskRequestAMY;
use App\Http\Requests\AssignTaskRequestAMY;
use App\Models\TaskAMY;
use App\Models\CategoryAMY;
use App\Models\User;
use App\Services\TaskServiceAMY;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskControllerAMY extends Controller
{
        use AuthorizesRequests;
    /**
     * Constructor: dependency injection of TaskService.
     * Authorization via policy is applied per-method.
     */
    public function __construct(private TaskServiceAMY $taskService) {}

    /** GET /tasks — List tasks (filtered by role and query params) */
    public function index(Request $request): View
    {
        $user   = Auth::user();
        $query  = TaskAMY::with(['assignee', 'creator', 'category'])->active();

        // Guests only see their own tasks
        if ($user->isGuest()) {
            $query->assignedTo($user->id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->withStatus($request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->withPriority($request->priority);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by assignee (admin/team_member only)
        if ($request->filled('assigned_to') && !$user->isGuest()) {
            $query->assignedTo($request->assigned_to);
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $tasks      = $query->latest()->paginate(15)->withQueryString();
        $categories = CategoryAMY::all();
        $users      = $user->isAdmin() ? User::all() : collect();

        return view('tasks.index', compact('tasks', 'categories', 'users'));
    }

    /** GET /tasks/create */
    public function create(): View
    {
        $this->authorize('create', TaskAMY::class);

        $categories = CategoryAMY::all();
        $users      = User::where('is_active', true)->get();

        return view('tasks.create', compact('categories', 'users'));
    }

    /** POST /tasks */
    public function store(StoreTaskRequestAMY $request): RedirectResponse
    {
        $this->authorize('create', TaskAMY::class);

        $task = $this->taskService->createTask(
            $request->validated(),
            Auth::user()
        );

        return redirect()->route('tasks.show', $task)
                         ->with('success', 'Task created successfully.');
    }

    /** GET /tasks/{task} */
    public function show(TaskAMY $task): View
    {
        $this->authorize('view', $task);

        $task->load(['assignee', 'creator', 'category', 'comments.author']);

        return view('tasks.show', compact('task'));
    }

    /** GET /tasks/{task}/edit */
    public function edit(TaskAMY $task): View
    {
        $this->authorize('update', $task);

        $categories = CategoryAMY::all();
        $users      = User::where('is_active', true)->get();

        return view('tasks.edit', compact('task', 'categories', 'users'));
    }

    /** PUT/PATCH /tasks/{task} */
    public function update(UpdateTaskRequestAMY $request, TaskAMY $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $this->taskService->updateTask($task, $request->validated());

        return redirect()->route('tasks.show', $task)
                         ->with('success', 'Task updated successfully.');
    }

    /** DELETE /tasks/{task} */
    public function destroy(TaskAMY $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted.');
    }

    /** PATCH /tasks/{task}/status — Update only the status */
    public function updateStatus(Request $request, TaskAMY $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $request->validate([
            'status' => ['required', 'in:pending,in_progress,completed,cancelled'],
        ]);

        $task->update(['status' => $request->status]);

        return back()->with('success', 'Task status updated.');
    }

    /** PATCH /tasks/{task}/assign */
    public function assign(AssignTaskRequestAMY $request, TaskAMY $task): RedirectResponse
    {
        $this->authorize('assign', $task);

        $this->taskService->assignTask($task, $request->assigned_to);

        return back()->with('success', 'Task assigned successfully.');
    }

    /** PATCH /tasks/{task}/archive */
    public function archive(TaskAMY $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->update(['is_archived' => !$task->is_archived]);

        $msg = $task->is_archived ? 'Task archived.' : 'Task unarchived.';
        return back()->with('success', $msg);
    }
}

