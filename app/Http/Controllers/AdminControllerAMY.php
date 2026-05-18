<?php


// =============================================================================
// FILE: app/Http/Controllers/AdminControllerAMY.php
// =============================================================================
namespace App\Http\Controllers;

use App\Models\TaskAMY;
use App\Models\CategoryAMY;
use App\Models\RoleAMY;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminControllerAMY extends Controller
{
    public function __construct()
    {
        // Applied via route middleware 'role:admin'
    }

    /** GET /admin — Admin dashboard with summary stats */
    public function index()
{
    $stats = [
        'total_tasks'      => TaskAMY::count(),
        'pending'          => TaskAMY::where('status', 'pending')->count(),
        'in_progress'      => TaskAMY::where('status', 'in_progress')->count(),
        'completed'        => TaskAMY::where('status', 'completed')->count(),
        'overdue'          => TaskAMY::overdue()->count(),
        'total_users'      => User::count(),
        'active_users'     => User::where('is_active', 1)->count(),
        'total_categories' => CategoryAMY::count(),
    ];

    $recentTasks = TaskAMY::with(['creator', 'assignee'])
        ->latest()
        ->limit(10)
        ->get();

    return view('admin.index', compact('stats', 'recentTasks'));
}

    /** GET /admin/users */
    public function users(): View
    {
        $users = User::with('role')->latest()->paginate(20);
        $roles = RoleAMY::all();
        return view('admin.users', compact('users', 'roles'));
    }

    /** PATCH /admin/users/{user}/role */
    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $request->validate(['role_id' => 'required|exists:roles,id']);
        $user->update(['role_id' => $request->role_id]);
        return back()->with('success', 'Role updated for ' . $user->name);
    }

    /** PATCH /admin/users/{user}/toggle — Enable/disable user */
    public function toggleActive(User $user): RedirectResponse
    {
        $user->update(['is_active' => !$user->is_active]);
        $status = $user->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "User {$user->name} {$status}.");
    }

    /** GET /admin/reports */
    public function reports(): View
    {
        $tasksByCategory = CategoryAMY::withCount('tasks')->get();
        $tasksByPriority = TaskAMY::selectRaw('priority, COUNT(*) as count')
                                   ->groupBy('priority')
                                   ->pluck('count', 'priority');
        $tasksByStatus   = TaskAMY::selectRaw('status, COUNT(*) as count')
                                   ->groupBy('status')
                                   ->pluck('count', 'status');

        return view('admin.reports', compact('tasksByCategory', 'tasksByPriority', 'tasksByStatus'));
    }

    /** GET /admin/activity-log */
    public function activityLog(): View
    {
        $logs = ActivityLog::with('user')->latest()->paginate(30);
        return view('admin.activity-log', compact('logs'));
    }
}
