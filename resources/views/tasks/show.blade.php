@extends('layouts.app')
@section('title', 'View Task')

@section('content')
<div class="py-8 max-w-3xl mx-auto px-4">

    <!-- HEADER ACTIONS -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('tasks.index') }}" class="group p-2 bg-white border border-slate-200 rounded-xl text-slate-500 hover:text-slate-800 hover:border-slate-300 shadow-sm transition">
                <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-2xl font-extrabold text-slate-900">Task Details</h1>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('tasks.edit', $task) }}"
               class="inline-flex items-center gap-1.5 bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-blue-700 shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M18.364 4.982a1.871 1.871 0 112.592 2.592l-12 124.918H5v-3.343l12-12z"></path></svg>
                Edit
            </a>
        </div>
    </div>

    <!-- MAIN PROFILE VIEW CARD -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden divide-y divide-slate-100">
        
        <!-- Main Title / Primary Group -->
        <div class="p-6 bg-slate-50/50">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Task Header Tracking</span>
            <h2 class="text-xl font-bold text-slate-900 mt-1">{{ $task->title }}</h2>
        </div>

        <!-- Description Container -->
        <div class="p-6">
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Detailed Context</h4>
            <div class="text-slate-700 text-sm leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-xl border border-slate-100">
                {!! nl2br(e($task->description ?? 'No extra structural descriptive text was added to this tracking item.')) !!}
            </div>
        </div>

        <!-- Parameters Meta Data Grid -->
        <div class="p-6 bg-white">
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Task Parameters</h4>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Status Badge logic built around TaskFlow Blue palette rules -->
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-slate-50 rounded-lg text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400">Status</p>
                        @php
                            $statusMap = [
                                'pending' => 'bg-slate-100 text-slate-700 border-slate-200',
                                'in_progress' => 'bg-blue-50 text-blue-700 border-blue-100',
                                'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                            ];
                        @endphp
                        <span class="mt-0.5 inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded-md border {{ $statusMap[$task->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>
                </div>

                <!-- Priority Badge rules built around native structural parameters -->
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-slate-50 rounded-lg text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400">Priority Profile</p>
                        @php
                            $priorityMap = [
                                'low' => 'bg-slate-100 text-slate-600',
                                'medium' => 'bg-blue-50 text-blue-600',
                                'high' => 'bg-orange-50 text-orange-700',
                                'critical' => 'bg-rose-50 text-rose-700 font-bold animate-pulse',
                            ];
                        @endphp
                        <span class="mt-0.5 inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded-md {{ $priorityMap[$task->priority] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </div>
                </div>

                <!-- Due Date Tracking Block -->
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-slate-50 rounded-lg text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400">System Deadline</p>
                        <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No target date explicitly defined' }}</p>
                    </div>
                </div>

                <!-- Assignee Tracking Block -->
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-slate-50 rounded-lg text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400">Assigned Workspace Agent</p>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-4 h-4 text-[9px] font-bold rounded-full bg-blue-600 text-white flex items-center justify-center uppercase">
                                {{ substr($task->assignedUser->name ?? 'U', 0, 1) }}
                            </span>
                            <span class="text-sm font-semibold text-slate-800">{{ $task->assignedUser->name ?? 'Unassigned' }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection