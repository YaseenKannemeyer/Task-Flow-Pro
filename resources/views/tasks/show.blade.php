@extends('layouts.app')
@section('title', 'View Task')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Task Details</h1>

        <div class="flex gap-2">
            <a href="{{ route('tasks.edit', $task) }}"
               class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600">
                Edit
            </a>

            <a href="{{ route('tasks.index') }}"
               class="px-4 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-50">
                Back
            </a>
        </div>
    </div>

    <div class="bg-white border rounded-xl p-6 space-y-4">

        <div>
            <p class="text-sm text-gray-500">Title</p>
            <p class="text-lg font-semibold">{{ $task->title }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Description</p>
            <p class="text-gray-800">
                {{ $task->description ?? 'No description' }}
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <p class="text-sm text-gray-500">Status</p>
                <p>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Priority</p>
                <p>{{ ucfirst($task->priority) }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Due Date</p>
                <p>{{ $task->due_date ?? '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Assigned To</p>
                <p>{{ $task->assignedUser->name ?? 'Unassigned' }}</p>
            </div>

        </div>

    </div>
</div>
@endsection