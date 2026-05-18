@extends('layouts.app')

@section('title', 'New Category')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">New Category</h1>

    <form method="POST" action="{{ route('categories.store') }}"
          class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
            <div class="flex items-center gap-3">
                <input type="color" name="color" value="{{ old('color', '#6366f1') }}"
                       class="w-10 h-10 rounded cursor-pointer border border-gray-300">
                <input type="text" id="colorText" value="{{ old('color', '#6366f1') }}"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-32 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                       readonly>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">{{ old('description') }}</textarea>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
                Create Category
            </button>
            <a href="{{ route('categories.index') }}"
               class="px-6 py-2 rounded-lg text-sm font-medium text-gray-600 border border-gray-300 hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
    document.querySelector('input[type=color]').addEventListener('input', function() {
        document.getElementById('colorText').value = this.value;
    });
</script>
@endsection
