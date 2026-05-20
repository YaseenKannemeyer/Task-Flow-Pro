@extends('layouts.app')

@section('title', 'My Assigned Tasks')

@section('content')
<div class="py-6 max-w-5xl mx-auto">

    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            My Assigned Tasks
        </h2>
    </div>

    <!-- Task List -->
    <div class="space-y-3">
        @forelse($tasks as $task)
            <div class="p-4 bg-white rounded-lg shadow">
                <h3 class="font-semibold text-gray-900">
                    {{ $task->title }}
                </h3>

                <p class="text-sm text-gray-500">
                    {{ ucfirst($task->status) }}
                </p>
            </div>
        @empty
            <p class="text-gray-500">
                No tasks assigned to you.
            </p>
        @endforelse
    </div>

</div>
@endsection