extends('layouts.app')

@section('title', 'Tasks')

@section('breadcrumb')
    <span>Tasks</span>
@endsection

@section('content')
    {{-- Header + Create button --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Tasks</h1>
        @can('create', App\Models\TaskAMY::class)
            <a href="{{ route('tasks.create') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors">
                + New Task
            </a>
        @endcan
    </div>

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('tasks.index') }}" class="bg-white border border-gray-200 rounded-xl p-4 mb-6 flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search tasks..."
               class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">

        <select name="status" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            <option value="">All Statuses</option>
            <option value="pending"     {{ request('status') === 'pending'     ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed"   {{ request('status') === 'completed'   ? 'selected' : '' }}>Completed</option>
            <option value="cancelled"   {{ request('status') === 'cancelled'   ? 'selected' : '' }}>Cancelled</option>
        </select>

        <select name="priority" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            <option value="">All Priorities</option>
            <option value="low"      {{ request('priority') === 'low'      ? 'selected' : '' }}>Low</option>
            <option value="medium"   {{ request('priority') === 'medium'   ? 'selected' : '' }}>Medium</option>
            <option value="high"     {{ request('priority') === 'high'     ? 'selected' : '' }}>High</option>
            <option value="critical" {{ request('priority') === 'critical' ? 'selected' : '' }}>Critical</option>
        </select>

        <select name="category" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            <option value="">All Categories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg text-sm hover:bg-indigo-700">
            Filter
        </button>
        <a href="{{ route('tasks.index') }}" class="text-sm text-gray-500 hover:text-gray-700 py-1.5">Clear</a>
    </form>

    {{-- Task grid --}}
    @if ($tasks->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-lg font-medium">No tasks found</p>
            <p class="text-sm mt-1">Try adjusting your filters or create a new task.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">
            @foreach ($tasks as $task)
                <x-task-card :task="$task" />
            @endforeach
        </div>
        {{-- Pagination --}}
        {{ $tasks->links() }}
    @endif
@endsection