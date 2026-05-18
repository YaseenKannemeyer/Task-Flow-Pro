@extends('layouts.app')

@section('title', 'Reports')

@section('content')

<div class="py-6 space-y-8">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Reports</h1>
        <p class="text-sm text-gray-500">Task analytics and system breakdown</p>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- CATEGORY -->
        <div class="bg-white rounded-xl shadow-sm border p-6">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Tasks by Category
            </h3>

            <div class="space-y-3">

                @forelse($tasksByCategory as $cat)

                    <div class="flex items-center justify-between py-2 border-b last:border-none">

                        <span class="text-gray-700 font-medium">
                            {{ $cat->name }}
                        </span>

                        <span class="px-2 py-1 text-xs rounded-full bg-indigo-50 text-indigo-700">
                            {{ $cat->tasks_count }}
                        </span>

                    </div>

                @empty
                    <p class="text-sm text-gray-500">No category data available</p>
                @endforelse

            </div>

        </div>

        <!-- PRIORITY -->
        <div class="bg-white rounded-xl shadow-sm border p-6">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Tasks by Priority
            </h3>

            <div class="space-y-3">

                @forelse($tasksByPriority as $priority => $count)

                    @php
                        $priorityColors = [
                            'low' => 'bg-green-100 text-green-700',
                            'medium' => 'bg-yellow-100 text-yellow-700',
                            'high' => 'bg-red-100 text-red-700',
                        ];
                    @endphp

                    <div class="flex items-center justify-between py-2 border-b last:border-none">

                        <span class="text-gray-700">
                            {{ ucfirst($priority) }}
                        </span>

                        <span class="px-2 py-1 text-xs rounded-full {{ $priorityColors[$priority] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $count }}
                        </span>

                    </div>

                @empty
                    <p class="text-sm text-gray-500">No priority data available</p>
                @endforelse

            </div>

        </div>

        <!-- STATUS -->
        <div class="bg-white rounded-xl shadow-sm border p-6">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Tasks by Status
            </h3>

            <div class="space-y-3">

                @forelse($tasksByStatus as $status => $count)

                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'in_progress' => 'bg-blue-100 text-blue-700',
                            'completed' => 'bg-green-100 text-green-700',
                            'overdue' => 'bg-red-100 text-red-700',
                        ];
                    @endphp

                    <div class="flex items-center justify-between py-2 border-b last:border-none">

                        <span class="text-gray-700">
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </span>

                        <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $count }}
                        </span>

                    </div>

                @empty
                    <p class="text-sm text-gray-500">No status data available</p>
                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection