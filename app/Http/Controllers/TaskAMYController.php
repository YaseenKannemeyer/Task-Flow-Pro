<?php

namespace App\Http\Controllers;

use App\Models\TaskAMY;
use App\Models\User;
use App\Models\CategoryAMY;
use Illuminate\Http\Request;

class TaskAMYController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskAMY::class, 'taskAMY');
    }

    // SHOW CREATE FORM (ADMIN CAN ACCESS BECAUSE POLICY ALLOWS)
    public function create()
    {
        return view('tasks.create', [
            'users' => User::all(),
            'categories' => CategoryAMY::all(),
        ]);
    }

    // STORE TASK
    public function store(Request $request)
    {
        $this->authorize('create', TaskAMY::class);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,in_progress,completed'],
            'priority' => ['required', 'in:low,medium,high,critical'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'due_date' => ['nullable', 'date'],
        ]);

        $validated['created_by'] = auth()->id();

        TaskAMY::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }
}