<?php

namespace App\Http\Controllers;

use App\Models\TaskAMY;
use App\Models\CategoryAMY;
use App\Models\User;

class DashboardControllerAMY extends Controller
{
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
}