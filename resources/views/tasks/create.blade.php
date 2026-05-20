@extends('layouts.app')
@section('title', 'Create Task')

@section('content')
<div class="py-8 max-w-2xl mx-auto px-4">
    
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('tasks.index') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-500 hover:text-slate-800 hover:border-slate-300 shadow-sm transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-2xl font-extrabold text-slate-900">Create Task</h1>
    </div>

    <form method="POST" action="{{ route('tasks.store') }}"  class="bg-white rounded-2xl border border-slate-100 p-6 space-y-6 shadow-sm">
        @csrf

        {{-- Title input component initialization --}}
        <div>
            <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Task Designation / Title <span class="text-blue-500">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                   class="w-full border {{ $errors->has('title') ? 'border-red-400 focus:ring-red-500/10 focus:border-red-500' : 'border-slate-200 focus:ring-blue-500/20 focus:border-blue-600' }} rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 transition"
                   placeholder="e.g. Wire up deadline reminder email queue">
            @error('title')
                <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description block tracking --}}
        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-1.5">Detailed Context Description</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition"
                      placeholder="Provide structural context for your assignees..."></textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status and Priority multi items structural container row --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 mb-1.5">Pipeline Status State</label>
                <select id="status" name="status" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition bg-white">
                    <option value="pending"     {{ old('status', 'pending') === 'pending'     ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status') === 'in_progress'            ? 'selected' : '' }}>In Progress</option>
                    <option value="completed"   {{ old('status') === 'completed'              ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div>
                <label for="priority" class="block text-sm font-semibold text-slate-700 mb-1.5">Task Urgency Matrix</label>
                <select id="priority" name="priority" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition bg-white">
                    <option value="low"      {{ old('priority') === 'low'      ? 'selected' : '' }}>Low</option>
                    <option value="medium"   {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high"     {{ old('priority') === 'high'     ? 'selected' : '' }}>High</option>
                    <option value="critical" {{ old('priority') === 'critical' ? 'selected' : '' }}>Critical</option>
                </select>
            </div>
        </div>

        {{-- Category Selection along assigned metadata entity row tracking rules --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-1.5">Assigned Category Folder</label>
                <select id="category_id" name="category_id" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition bg-white">
                    <option value="">No Category Envelope</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="assigned_to" class="block text-sm font-semibold text-slate-700 mb-1.5">Assign Task To Agent</label>
                <select id="assigned_to" name="assigned_to" class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition bg-white">
                    <option value="">Leave Unassigned</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Due Date tracking element integration --}}
        <div>
            <label for="due_date" class="block text-sm font-semibold text-slate-700 mb-1.5">Execution Due Date / Deadline</label>
            <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}"
                   min="{{ now()->format('Y-m-d') }}"
                   class="w-full border {{ $errors->has('due_date') ? 'border-red-400 focus:ring-red-500/10 focus:border-red-500' : 'border-slate-200 focus:ring-blue-500/20 focus:border-blue-600' }} rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 transition">
            @error('due_date')
                <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit and Interactive actions buttons --}}
        <div class="flex gap-3 pt-2 border-t border-slate-100">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-sm hover:bg-blue-700 transition">
                Deploy Task Profile
            </button>
            <a href="{{ route('tasks.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">
                Dismiss
            </a>
        </div>
    </form>
</div>
@endsection