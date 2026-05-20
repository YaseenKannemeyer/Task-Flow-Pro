@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="py-8 space-y-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-100 pb-5">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Dashboard Overview</h1>
            <p class="mt-1 text-sm text-slate-500">Real-time task analytics and system tracking.</p>
        </div>
        <div class="flex items-center gap-2 self-start sm:self-center bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg text-sm font-medium">
            <span class="w-2 height w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
            Live stats summary
        </div>
    </div>

    <!-- MAIN STATS CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Tasks -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 rounded-2xl shadow-sm text-white hover:shadow-md hover:scale-[1.01] transition-all duration-200">
            <p class="text-xs font-semibold uppercase tracking-wider text-blue-100">Total Tasks</p>
            <div class="flex items-baseline justify-between mt-2">
                <p class="text-4xl font-extrabold tracking-tight">{{ $stats['total_tasks'] }}</p>
                <div class="p-2 bg-white/10 rounded-lg">
                    <svg class="w-6 h-6 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-slate-200 hover:scale-[1.01] transition-all duration-200">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Pending</p>
            <div class="flex items-baseline justify-between mt-2">
                <p class="text-4xl font-extrabold tracking-tight text-slate-700">{{ $stats['pending'] }}</p>
                <div class="p-2 bg-slate-50 rounded-lg text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- In Progress -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-slate-200 hover:scale-[1.01] transition-all duration-200">
            <p class="text-xs font-semibold uppercase tracking-wider text-blue-600">In Progress</p>
            <div class="flex items-baseline justify-between mt-2">
                <p class="text-4xl font-extrabold tracking-tight text-blue-600">{{ $stats['in_progress'] }}</p>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-slate-200 hover:scale-[1.01] transition-all duration-200">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">Completed</p>
            <div class="flex items-baseline justify-between mt-2">
                <p class="text-4xl font-extrabold tracking-tight text-emerald-600">{{ $stats['completed'] }}</p>
                <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
            </div>
        </div>

    </div>

    <!-- SECOND ROW -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

        <!-- Overdue -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-rose-500">Overdue Tasks</p>
                <p class="text-3xl font-extrabold tracking-tight text-rose-600 mt-1">{{ $stats['overdue'] }}</p>
            </div>
            <div class="p-3 bg-rose-50 text-rose-500 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Team</p>
                <p class="text-3xl font-extrabold tracking-tight text-slate-800 mt-1">{{ $stats['total_users'] }}</p>
            </div>
            <div class="p-3 bg-slate-50 text-slate-500 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>

        <!-- Active Users -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all duration-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-blue-500">Active Now</p>
                <p class="text-3xl font-extrabold tracking-tight text-blue-600 mt-1">{{ $stats['active_users'] }}</p>
            </div>
            <div class="p-3 bg-blue-50 text-blue-500 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
        </div>

    </div>

    <!-- RECENT TASKS CONTAINER -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        <!-- Table Header -->
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div>
                <h3 class="text-lg font-bold text-slate-800">Recent Tasks</h3>
                <p class="text-xs text-slate-500 mt-0.5">Overview of the most recently structural adjustments.</p>
            </div>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                Latest Activity
            </span>
        </div>

        <!-- Responsive Table Layout -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left whitespace-nowrap">

                <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="py-4 px-6">Title</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6">Creator</th>
                        <th class="py-4 px-6">Assignee</th>
                        <th class="py-4 px-6 text-right">Created</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($recentTasks as $task)
                        <tr class="hover:bg-slate-50/70 transition-colors group">

                            <!-- Title alongside a brand accent dynamic edge border decoration -->
                            <td class="py-4 px-6 font-semibold text-slate-800 relative">
                                <span class="absolute left-0 top-0 bottom-0 w-1 bg-transparent group-hover:bg-blue-600 transition-colors"></span>
                                {{ $task->title }}
                            </td>

                            <!-- Badges -->
                            <td class="py-4 px-6">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-slate-100 text-slate-700 ring-slate-600/10',
                                        'in_progress' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
                                        'completed' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/10',
                                    ];
                                @endphp

                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-md ring-1 ring-inset {{ $statusColors[$task->status] ?? 'bg-gray-100 text-gray-600 ring-gray-500/10' }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </td>

                            <!-- Creator Entity -->
                            <td class="py-4 px-6 text-slate-600 font-medium">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-700 text-[10px] font-bold flex items-center justify-center uppercase">
                                        {{ substr($task->creator->name ?? '—', 0, 2) }}
                                    </div>
                                    <span>{{ $task->creator->name ?? '—' }}</span>
                                </div>
                            </td>

                            <!-- Assignee Entity -->
                            <td class="py-4 px-6 text-slate-600 font-medium">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-blue-50 text-blue-700 text-[10px] font-bold flex items-center justify-center uppercase">
                                        {{ substr($task->assignee->name ?? '—', 0, 2) }}
                                    </div>
                                    <span>{{ $task->assignee->name ?? '—' }}</span>
                                </div>
                            </td>

                            <!-- Time Diff Column -->
                            <td class="py-4 px-6 text-right text-slate-400 font-medium text-xs">
                                {{ $task->created_at->diffForHumans() }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400 font-medium">
                                No recent tasks found. Get started by creating your first task!
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection