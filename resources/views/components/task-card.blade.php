@props(['task'])

<div class="bg-white rounded-xl border border-gray-200 p-4 hover:shadow-md transition-shadow">
    <div class="flex items-start justify-between gap-2">
        <div class="flex-1 min-w-0">
            <h3 class="font-semibold text-gray-900 truncate">
                <a href="{{ route('tasks.show', $task) }}" class="hover:text-indigo-600">
                    {{ $task->title }}
                </a>
            </h3>
            @if ($task->category)
                <p class="text-xs text-gray-400 mt-0.5">{{ $task->category->name }}</p>
            @endif
        </div>
        {{-- Priority badge --}}
        <x-priority-badge :priority="$task->priority" />
    </div>

    {{-- Status + due date row --}}
    <div class="flex items-center gap-2 mt-3">
        <x-status-badge :status="$task->status" />
        @if ($task->due_date)
            <span class="text-xs {{ $task->is_overdue ? 'text-red-600 font-medium' : 'text-gray-400' }}">
                Due {{ $task->due_date->format('d M') }}
                @if ($task->is_overdue) (Overdue) @endif
            </span>
        @endif
    </div>

    {{-- Assignee avatar --}}
    @if ($task->assignee)
        <div class="flex items-center gap-1.5 mt-3">
            <span class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 text-xs flex items-center justify-center font-semibold">
                {{ $task->assignee->initials }}
            </span>
            <span class="text-xs text-gray-500">{{ $task->assignee->name }}</span>
        </div>
    @endif
</div>