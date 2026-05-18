{{--
    resources/views/components/task-card.blade.php

    Usage examples:
        Basic:
            <x-task-card :task="$task" />

        With quick actions (edit/delete buttons):
            <x-task-card :task="$task" :show-actions="true" />

        Hide assignee and category:
            <x-task-card :task="$task" :show-assignee="false" :show-category="false" />

    Props (injected by TaskCard.php):
        $task          — TaskAMY model instance (required)
        $showAssignee  — bool, default true
        $showActions   — bool, default false
        $showCategory  — bool, default true

    Design: Clean white card with left accent border that changes colour
    by priority. Subtle lift on hover. No inline CSS — all Tailwind classes.
    All user data escaped with {{ }}.
--}}

<div
    class="
        group relative bg-white rounded-2xl border border-gray-100
        shadow-sm hover:shadow-md transition-all duration-200
        hover:-translate-y-0.5 overflow-hidden
        {{ $task->is_overdue ? 'ring-1 ring-red-300' : '' }}
    "
>
    {{-- ── Priority accent bar (left edge) ── --}}
    <div class="
        absolute left-0 top-0 bottom-0 w-1 rounded-l-2xl
        {{ match($task->priority) {
            'critical' => 'bg-red-500',
            'high'     => 'bg-orange-400',
            'medium'   => 'bg-yellow-400',
            'low'      => 'bg-emerald-400',
            default    => 'bg-gray-300',
        } }}
    "></div>

    <div class="pl-5 pr-4 pt-4 pb-4">

        {{-- ── Top row: category pill + status badge ── --}}
        <div class="flex items-center justify-between gap-2 mb-3">

            {{-- Category --}}
            @if ($showCategory && $task->category)
                <span
                    class="inline-flex items-center gap-1.5 text-xs font-medium px-2 py-0.5 rounded-full"
                    style="
                        background-color: {{ $task->category->color }}22;
                        color: {{ $task->category->color }};
                    "
                >
                    {{-- Colour dot matching category hex --}}
                    <span
                        class="w-1.5 h-1.5 rounded-full"
                        style="background-color: {{ $task->category->color }};"
                        aria-hidden="true"
                    ></span>
                    {{ $task->category->name }}
                </span>
            @else
                <span></span>
            @endif

            {{-- Status badge --}}
            <span class="
                inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium whitespace-nowrap
                {{ match($task->status) {
                    'pending'     => 'bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200',
                    'in_progress' => 'bg-blue-50 text-blue-700 ring-1 ring-blue-200',
                    'completed'   => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200',
                    'cancelled'   => 'bg-gray-100 text-gray-500 ring-1 ring-gray-200',
                    default       => 'bg-gray-100 text-gray-500',
                } }}
            ">
                {{-- Status icon --}}
                @if ($task->status === 'completed')
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                @elseif ($task->status === 'in_progress')
                    <svg class="w-3 h-3 mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                @elseif ($task->status === 'cancelled')
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                @else
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                @endif
                {{ $task->status_label }}
            </span>
        </div>

        {{-- ── Task title ── --}}
        <h3 class="font-semibold text-gray-900 text-sm leading-snug mb-1 line-clamp-2">
            <a
                href="{{ route('tasks.show', $task) }}"
                class="hover:text-indigo-600 transition-colors focus:outline-none focus:underline"
            >
                {{-- Escaped title — XSS safe --}}
                {{ $task->title }}
            </a>
        </h3>

        {{-- ── Description preview (optional) ── --}}
        @if ($task->description)
            <p class="text-xs text-gray-400 leading-relaxed line-clamp-2 mb-3">
                {{ $task->description }}
            </p>
        @else
            <div class="mb-3"></div>
        @endif

        {{-- ── Meta row: priority + due date ── --}}
        <div class="flex items-center gap-2 flex-wrap mb-3">

            {{-- Priority pill --}}
            <span class="
                inline-flex items-center gap-1 text-xs font-medium px-2 py-0.5 rounded-full
                {{ match($task->priority) {
                    'critical' => 'bg-red-50 text-red-600 ring-1 ring-red-200',
                    'high'     => 'bg-orange-50 text-orange-600 ring-1 ring-orange-200',
                    'medium'   => 'bg-yellow-50 text-yellow-600 ring-1 ring-yellow-200',
                    'low'      => 'bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200',
                    default    => 'bg-gray-100 text-gray-500',
                } }}
            ">
                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 7l2.55 2.4A1 1 0 0116 11H6a3 3 0 01-3-3V6z" clip-rule="evenodd"/>
                </svg>
                {{ $task->priority_label }}
            </span>

            {{-- Due date --}}
            @if ($task->due_date)
                <span class="
                    inline-flex items-center gap-1 text-xs
                    {{ $task->is_overdue
                        ? 'text-red-600 font-semibold'
                        : ($task->days_remaining !== null && $task->days_remaining <= 3
                            ? 'text-orange-500 font-medium'
                            : 'text-gray-400') }}
                ">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    @if ($task->is_overdue)
                        Overdue · {{ $task->due_date->format('d M') }}
                    @elseif ($task->days_remaining === 0)
                        Due today
                    @elseif ($task->days_remaining === 1)
                        Due tomorrow
                    @else
                        {{ $task->due_date->format('d M Y') }}
                    @endif
                </span>
            @endif

            {{-- Completed checkmark --}}
            @if ($task->completed_at)
                <span class="text-xs text-emerald-500 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $task->completed_at->format('d M') }}
                </span>
            @endif
        </div>

        {{-- ── Divider ── --}}
        <div class="border-t border-gray-100 mb-3"></div>

        {{-- ── Bottom row: assignee + actions ── --}}
        <div class="flex items-center justify-between gap-2">

            {{-- Assignee --}}
            @if ($showAssignee)
                @if ($task->assignee)
                    <div class="flex items-center gap-2 min-w-0">
                        {{-- Avatar circle with initials --}}
                        <div
                            class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold flex items-center justify-center shrink-0 ring-2 ring-white"
                            title="{{ $task->assignee->name }}"
                            aria-label="Assigned to {{ $task->assignee->name }}"
                        >
                            {{ $task->assignee->initials }}
                        </div>
                        <span class="text-xs text-gray-500 truncate">
                            {{ $task->assignee->name }}
                        </span>
                    </div>
                @else
                    <span class="text-xs text-gray-300 italic">Unassigned</span>
                @endif
            @else
                <span></span>
            @endif

            {{-- Quick actions --}}
            @if ($showActions)
                <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">

                    {{-- Edit --}}
                    @can('update', $task)
                        <a
                            href="{{ route('tasks.edit', $task) }}"
                            class="p-1.5 rounded-lg text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 transition-colors"
                            title="Edit task"
                            aria-label="Edit {{ $task->title }}"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                    @endcan

                    {{-- Quick status toggle: mark complete / reopen --}}
                    @can('update', $task)
                        <form
                            method="POST"
                            action="{{ route('tasks.status', $task) }}"
                            class="inline"
                        >
                            @csrf
                            @method('PATCH')
                            <input
                                type="hidden"
                                name="status"
                                value="{{ $task->status === 'completed' ? 'pending' : 'completed' }}"
                            >
                            <button
                                type="submit"
                                class="p-1.5 rounded-lg text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 transition-colors"
                                title="{{ $task->status === 'completed' ? 'Reopen task' : 'Mark complete' }}"
                                aria-label="{{ $task->status === 'completed' ? 'Reopen' : 'Complete' }} {{ $task->title }}"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                        </form>
                    @endcan

                    {{-- Delete --}}
                    @can('delete', $task)
                        <form
                            method="POST"
                            action="{{ route('tasks.destroy', $task) }}"
                            class="inline"
                            onsubmit="return confirm('Delete \'{{ addslashes($task->title) }}\'?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors"
                                title="Delete task"
                                aria-label="Delete {{ $task->title }}"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    @endcan
                </div>
            @endif

        </div>{{-- end bottom row --}}

    </div>{{-- end padded content --}}

    {{-- ── Archived ribbon ── --}}
    @if ($task->is_archived)
        <div class="absolute top-2 right-2">
            <span class="text-xs bg-gray-100 text-gray-400 px-2 py-0.5 rounded-full ring-1 ring-gray-200">
                Archived
            </span>
        </div>
    @endif

</div>{{-- end card --}}