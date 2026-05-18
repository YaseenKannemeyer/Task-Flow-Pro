@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <span class="w-4 h-4 rounded-full" style="background-color: {{ $category->color }}"></span>
        <h1 class="text-2xl font-bold text-gray-900">{{ $category->name }}</h1>
    </div>
    @can('update', $category)
        <a href="{{ route('categories.edit', $category) }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
            Edit
        </a>
    @endcan
</div>

@if ($category->description)
    <p class="text-gray-500 mb-6">{{ $category->description }}</p>
@endif

<h2 class="text-lg font-semibold text-gray-800 mb-4">Tasks in this category ({{ $category->tasks->count() }})</h2>

@if ($category->tasks->isEmpty())
    <p class="text-gray-400">No tasks in this category.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach ($category->tasks as $task)
            <x-task-card :task="$task" :show-actions="true" />
        @endforeach
    </div>
@endif
@endsection
