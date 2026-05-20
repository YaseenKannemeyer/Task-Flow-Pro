@extends('layouts.app')

@section('title', 'My Assigned Tasks')

@section('content')
<div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between border-b border-slate-100 pb-5">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">
                My Assigned Tasks
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                All tasks currently assigned directly to you.
            </p>
        </div>

        @can('create', App\Models\TaskXYZ::class)
            <a href="{{ route('tasks.create') }}"
               class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm hover:bg-blue-700 hover:shadow transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                New Task
            </a>
        @endcan
    </div>

    <!-- MAIN BODY -->
    @if($tasks->isEmpty())
        <div class="text-center py-16 bg-white border border-slate-100 rounded-2xl shadow-sm">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl inline-block mb-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                </svg>
            </div>
            <h3 class="text-slate-800 font-bold text-lg">No assigned tasks</h3>
            <p class="text-slate-400 text-sm max-w-sm mx-auto mt-1">
                You currently have no tasks assigned to you. New tasks will appear here automatically.
            </p>
        </div>
    @else

        <!-- TABLE -->
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">

            <!-- TABLE HEADER -->
            <div class="hidden sm:grid grid-cols-12 px-6 py-3 bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                <div class="col-span-5">Task</div>
                <div class="col-span-2">Status</div>
                <div class="col-span-2">Priority</div>
                <div class="col-span-3 text-right">Actions</div>
            </div>

            <!-- ROWS -->
            <div class="divide-y divide-slate-100">

                @foreach($tasks as $task)
                    @php
                        $status = strtolower($task->status);
                        $priority = strtolower($task->priority ?? 'low');
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 px-6 py-4 hover:bg-slate-50 transition">

                        <!-- TASK -->
                        <div class="sm:col-span-5">
                            <p class="font-semibold text-slate-900">
                                {{ $task->title }}
                            </p>
                            <p class="text-xs text-slate-400">
                                #{{ $task->id }}
                            </p>
                        </div>

                        <!-- STATUS -->
                        <div class="sm:col-span-2 flex items-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                @if($status === 'completed')
                                    bg-green-100 text-green-700
                                @elseif($status === 'in progress')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-slate-100 text-slate-600
                                @endif
                            ">
                                {{ ucfirst($task->status) }}
                            </span>
                        </div>

                        <!-- PRIORITY -->
                        <div class="sm:col-span-2 flex items-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                @if($priority === 'high')
                                    bg-red-100 text-red-700
                                @elseif($priority === 'medium')
                                    bg-orange-100 text-orange-700
                                @else
                                    bg-blue-100 text-blue-700
                                @endif
                            ">
                                {{ ucfirst($priority) }}
                            </span>
                        </div>

                        <!-- ACTIONS -->
                        <div class="sm:col-span-3 flex sm:justify-end gap-2 items-center">

                            <a href="#"
                               class="text-xs font-semibold text-blue-600 hover:text-blue-800">
                                View
                            </a>

                            @can('update', $task)
                                <a href="#"
                                   class="text-xs font-semibold text-slate-600 hover:text-slate-800">
                                    Edit
                                </a>
                            @endcan

                        </div>

                    </div>
                @endforeach

            </div>
        </div>

        <!-- PAGINATION -->
        <div class="mt-8 border-t border-slate-100 pt-4">
            {{ $tasks->links() }}
        </div>

    @endif

</div>
@endsection