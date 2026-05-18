@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="py-6 space-y-8">

    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
        <span class="text-sm text-gray-500">Live stats summary</span>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-gradient-to-br from-indigo-50 to-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
            <p class="text-sm text-gray-500">Total Tasks</p>
            <p class="text-3xl font-bold text-gray-800">{{ $stats['total_tasks'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
            <p class="text-sm text-gray-500">Pending</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
            <p class="text-sm text-gray-500">In Progress</p>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['in_progress'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
            <p class="text-sm text-gray-500">Completed</p>
            <p class="text-3xl font-bold text-green-600">{{ $stats['completed'] }}</p>
        </div>

    </div>

    <!-- SECOND ROW -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
            <p class="text-sm text-gray-500">Overdue</p>
            <p class="text-3xl font-bold text-red-600">{{ $stats['overdue'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
            <p class="text-sm text-gray-500">Total Users</p>
            <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
            <p class="text-sm text-gray-500">Active Users</p>
            <p class="text-3xl font-bold text-green-600">{{ $stats['active_users'] }}</p>
        </div>

    </div>

    <!-- RECENT TASKS -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

        <div class="p-6 border-b flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">Recent Tasks</h3>
            <span class="text-sm text-gray-500">Latest activity</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 text-left">Title</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Creator</th>
                        <th class="py-3 px-4 text-left">Assignee</th>
                        <th class="py-3 px-4 text-left">Created</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @foreach($recentTasks as $task)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="py-3 px-4 font-medium text-gray-800">
                                {{ $task->title }}
                            </td>

                            <td class="py-3 px-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'in_progress' => 'bg-blue-100 text-blue-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                    ];
                                @endphp

                                <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$task->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </td>

                            <td class="py-3 px-4 text-gray-600">
                                {{ $task->creator->name ?? '—' }}
                            </td>

                            <td class="py-3 px-4 text-gray-600">
                                {{ $task->assignee->name ?? '—' }}
                            </td>

                            <td class="py-3 px-4 text-gray-500">
                                {{ $task->created_at->diffForHumans() }}
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection