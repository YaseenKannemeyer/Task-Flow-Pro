@extends('layouts.app')
@section('title', 'Edit Task')

@section('content')
<div class="py-8 max-w-2xl mx-auto px-4">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('tasks.index') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-500 hover:text-slate-800 hover:border-slate-300 shadow-sm transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-2xl font-extrabold text-slate-900">Edit Task</h1>
    </div>

    <form method="POST" action="{{ route('tasks.update', $task) }}"
          class="bg-white border border-slate-100 rounded-2xl p-6 space-y-6 shadow-sm">

        @csrf
        @method('PUT')

        {{-- Title Input Field Component --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Task Designation / Title</label>
            <input type="text" name="title"
                   value="{{ old('title', $task->title) }}"
                   class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition">
            @error('title')
                <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description Textarea Field Component --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Task Content Description</label>
            <textarea name="description" rows="4"
                      class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
            @enderror
        </div>

        {{-- Row parameters group --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- Status dropdown setup --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Processing Pipeline State</label>
                <select name="status" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition bg-white">
                    <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            {{-- Priority dropdown setup --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Urgency Matrix Priority</label>
                <select name="priority" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition bg-white">
                    <option value="low" {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>High</option>
                    <option value="critical" {{ old('priority', $task->priority) === 'critical' ? 'selected' : '' }}>Critical</option>
                </select>
            </div>

        </div>

        {{-- Due Date tracking option --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Target Project Deadline</label>
            <input type="date" name="due_date"
                   value="{{ old('due_date', $task->due_date) }}"
                   class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition">
            @error('due_date')
                <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
            @enderror
        </div>

        {{-- Interaction Form Action buttons --}}
        <div class="flex gap-3 pt-2 border-t border-slate-100">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm hover:bg-blue-700 transition">
                Save Adjustments
            </button>

            <a href="{{ route('tasks.index') }}"
               class="px-5 py-2.5 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                Cancel Update
            </a>
        </div>

    </form>
</div>
@endsection