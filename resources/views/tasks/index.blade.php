@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Tasks</h1>
    @can('create', App\Models\TaskXYZ::class)
        <a href="{{ route('tasks.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
            + New Task
        </a>
    @endcan
</div>

@if($tasks->isEmpty())
    <p class="text-gray-400">No tasks found.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach($tasks as $task)
            <x-task-card :task="$task" :show-actions="true" />
        @endforeach
    </div>
    <div class="mt-6">{{ $tasks->links() }}</div>
@endif
@endsection