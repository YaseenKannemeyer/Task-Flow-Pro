@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between border-b border-slate-100 pb-5">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Workspace Tasks</h1>
            <p class="mt-1 text-sm text-slate-500">Manage, organize, and track your ongoing team processes.</p>
        </div>
        @can('create', App\Models\TaskXYZ::class)
            <a href="{{ route('tasks.create') }}"
               class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm hover:bg-blue-700 hover:shadow transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                New Task
            </a>
        @endcan
    </div>

    <!-- MAIN BODY -->
    @if($tasks->isEmpty())
        <div class="text-center py-16 bg-white border border-slate-100 rounded-2xl shadow-sm">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl inline-block mb-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"></path></svg>
            </div>
            <h3 class="text-slate-800 font-bold text-lg">No tasks allocated</h3>
            <p class="text-slate-400 text-sm max-w-sm mx-auto mt-1">Your task queue is clear. Create a brand new workspace tracking profile above.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($tasks as $task)
                <div class="hover:scale-[1.01] transition-transform duration-200">
                    <x-task-card :task="$task" :show-actions="true" />
                </div>
            @endforeach
        </div>
        <div class="mt-8 border-t border-slate-100 pt-4">
            {{ $tasks->links() }}
        </div>
    @endif

</div>
@endsection