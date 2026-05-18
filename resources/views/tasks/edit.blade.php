@extends('layouts.app')
@section('title', 'Edit Task')

@section('content')
<div class="max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Task</h1>

    <form method="POST" action="{{ route('tasks.update', $task) }}"
          class="bg-white border rounded-xl p-6 space-y-5">

        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label class="text-sm font-medium">Title</label>
            <input type="text" name="title"
                   value="{{ old('title', $task->title) }}"
                   class="w-full border rounded-lg px-3 py-2 mt-1">
        </div>

        {{-- Description --}}
        <div>
            <label class="text-sm font-medium">Description</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded-lg px-3 py-2 mt-1">{{ old('description', $task->description) }}</textarea>
        </div>

        {{-- Status --}}
        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="text-sm font-medium">Status</label>
                <select name="status" class="w-full border rounded-lg px-3 py-2 mt-1">
                    <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-medium">Priority</label>
                <select name="priority" class="w-full border rounded-lg px-3 py-2 mt-1">
                    <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
                    <option value="critical" {{ $task->priority === 'critical' ? 'selected' : '' }}>Critical</option>
                </select>
            </div>

        </div>

        {{-- Due Date --}}
        <div>
            <label class="text-sm font-medium">Due Date</label>
            <input type="date" name="due_date"
                   value="{{ old('due_date', $task->due_date) }}"
                   class="w-full border rounded-lg px-3 py-2 mt-1">
        </div>

        {{-- Buttons --}}
        <div class="flex gap-3">
            <button class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700">
                Update
            </button>

            <a href="{{ route('tasks.index') }}"
               class="px-5 py-2 border rounded-lg text-gray-600 hover:bg-gray-50">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection