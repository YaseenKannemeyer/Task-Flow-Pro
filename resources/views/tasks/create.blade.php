@extends('layouts.app')
@section('title', 'Create Task')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Create Task</h1>

    <form method="POST" action="{{ route('tasks.store') }}"  class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
        @csrf

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                   class="w-full border {{ $errors->has('title') ? 'border-red-400' : 'border-gray-300' }} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                   placeholder="Enter task title">
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                      placeholder="Describe the task...">{{ old('description') }}</textarea>
        </div>

        {{-- Status + Priority --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    <option value="pending"     {{ old('status', 'pending') === 'pending'     ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status') === 'in_progress'            ? 'selected' : '' }}>In Progress</option>
                    <option value="completed"   {{ old('status') === 'completed'              ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                <select id="priority" name="priority" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    <option value="low"      {{ old('priority') === 'low'      ? 'selected' : '' }}>Low</option>
                    <option value="medium"   {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high"     {{ old('priority') === 'high'     ? 'selected' : '' }}>High</option>
                    <option value="critical" {{ old('priority') === 'critical' ? 'selected' : '' }}>Critical</option>
                </select>
            </div>
        </div>

        {{-- Category + Assignee --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select id="category_id" name="category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    <option value="">No Category</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-1">Assign To</label>
                <select id="assigned_to" name="assigned_to" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    <option value="">Unassigned</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Due Date --}}
        <div>
            <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
            <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}"
                   min="{{ now()->format('Y-m-d') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('due_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors">
                Create Task
            </button>
            <a href="{{ route('tasks.index') }}" class="px-6 py-2 rounded-lg text-sm font-medium text-gray-600 border border-gray-300 hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection