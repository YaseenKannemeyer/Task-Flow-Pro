@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Categories</h1>
    @can('create', App\Models\CategoryAMY::class)
        <a href="{{ route('categories.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
            + New Category
        </a>
    @endcan
</div>

@if ($categories->isEmpty())
    <p class="text-gray-400">No categories yet.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">
        @foreach ($categories as $category)
            <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full" style="background-color: {{ $category->color }}"></span>
                        <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                    </div>
                    <span class="text-xs text-gray-400">{{ $category->tasks_count }} tasks</span>
                </div>
                @if ($category->description)
                    <p class="text-sm text-gray-500 mb-3">{{ $category->description }}</p>
                @endif
                <div class="flex items-center gap-2 mt-3">
                    <a href="{{ route('categories.show', $category) }}"
                       class="text-xs text-indigo-600 hover:underline">View</a>
                    @can('update', $category)
                        <a href="{{ route('categories.edit', $category) }}"
                           class="text-xs text-gray-500 hover:underline">Edit</a>
                    @endcan
                    @can('delete', $category)
                        <form method="POST" action="{{ route('categories.destroy', $category) }}"
                              onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:underline">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>
    {{ $categories->links() }}
@endif
@endsection
