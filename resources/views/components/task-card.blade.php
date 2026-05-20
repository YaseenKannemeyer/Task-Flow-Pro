<div
    class="
        group relative bg-white rounded-2xl border border-slate-100
        shadow-sm hover:shadow-lg hover:shadow-slate-200/40
        transition-all duration-300 ease-out
        hover:-translate-y-1 overflow-hidden
        {{ $task->is_overdue ? 'ring-1 ring-red-200/70' : '' }}
    "
>

    {{-- Left accent bar --}}
    <div class="
        absolute left-0 top-0 bottom-0 w-1 rounded-l-2xl
        {{ match($task->priority) {
            'critical' => 'bg-red-500',
            'high'     => 'bg-orange-400',
            'medium'   => 'bg-yellow-400',
            'low'      => 'bg-emerald-400',
            default    => 'bg-slate-300',
        } }}
    "></div>

    <div class="pl-5 pr-4 pt-4 pb-4">

        {{-- Top row --}}
        <div class="flex items-center justify-between mb-3">

            {{-- Category --}}
            @if ($showCategory && $task->category)
                <span
                    class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full
                           border border-slate-100 shadow-sm"
                    style="
                        background-color: {{ $task->category->color }}10;
                        color: {{ $task->category->color }};
                    "
                >
                    <span
                        class="w-1.5 h-1.5 rounded-full"
                        style="background-color: {{ $task->category->color }};"
                    ></span>
                    {{ $task->category->name }}
                </span>
            @endif

            {{-- Status --}}
            <span class="
                inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium
                border
                {{ match($task->status) {
                    'pending'     => 'bg-amber-50 text-amber-700 border-amber-100',
                    'in_progress' => 'bg-blue-50 text-blue-700 border-blue-100',
                    'completed'   => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                    'cancelled'   => 'bg-slate-100 text-slate-500 border-slate-200',
                    default       => 'bg-slate-100 text-slate-500',
                } }}
            ">
                {{ $task->status_label }}
            </span>
        </div>

        {{-- Title --}}
        <h3 class="font-semibold text-slate-900 text-sm leading-snug mb-1 line-clamp-2">
            <a
                href="{{ route('tasks.show', $task) }}"
                class="hover:text-blue-600 transition-colors"
            >
                {{ $task->title }}
            </a>
        </h3>

        {{-- Description --}}
        @if ($task->description)
            <p class="text-xs text-slate-500 leading-relaxed line-clamp-2 mb-3">
                {{ $task->description }}
            </p>
        @endif

        {{-- Meta --}}
        <div class="flex items-center gap-2 flex-wrap mb-3">

            {{-- Priority --}}
            <span class="
                inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full
                border
                {{ match($task->priority) {
                    'critical' => 'bg-red-50 text-red-600 border-red-100',
                    'high'     => 'bg-orange-50 text-orange-600 border-orange-100',
                    'medium'   => 'bg-amber-50 text-amber-600 border-amber-100',
                    'low'      => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                    default    => 'bg-slate-100 text-slate-500 border-slate-200',
                } }}
            ">
                {{ $task->priority_label }}
            </span>

            {{-- Due date --}}
            @if ($task->due_date)
                <span class="
                    inline-flex items-center gap-1 text-xs
                    {{ $task->is_overdue
                        ? 'text-red-600 font-medium'
                        : 'text-slate-400' }}
                ">
                    {{ $task->due_date->format('d M Y') }}
                </span>
            @endif
        </div>

        <div class="border-t border-slate-100 mb-3"></div>

        {{-- Bottom row --}}
        <div class="flex items-center justify-between">

            {{-- Assignee --}}
            @if ($showAssignee)
                @if ($task->assignee)
                    <div class="flex items-center gap-2">
                        <div class="
                            w-7 h-7 rounded-xl bg-blue-50 text-blue-700
                            flex items-center justify-center text-xs font-semibold
                            ring-1 ring-blue-100
                        ">
                            {{ $task->assignee->initials }}
                        </div>
                        <span class="text-xs text-slate-500">
                            {{ $task->assignee->name }}
                        </span>
                    </div>
                @else
                    <span class="text-xs text-slate-300">Unassigned</span>
                @endif
            @endif

            {{-- Actions --}}
            @if ($showActions)
                <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition">

                    @can('update', $task)
                        <a href="{{ route('tasks.edit', $task) }}"
                           class="p-2 rounded-xl text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition">
                            ✎
                        </a>
                    @endcan

                    @can('delete', $task)
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                            @csrf @method('DELETE')
                            <button class="p-2 rounded-xl text-slate-400 hover:text-red-600 hover:bg-red-50 transition">
                                🗑
                            </button>
                        </form>
                    @endcan

                </div>
            @endif

        </div>

    </div>
</div>