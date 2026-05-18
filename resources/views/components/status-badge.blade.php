@props(['status'])

@php
    $colors = [
        'pending'     => 'bg-yellow-100 text-yellow-800',
        'in_progress' => 'bg-blue-100 text-blue-800',
        'completed'   => 'bg-green-100 text-green-800',
        'cancelled'   => 'bg-gray-100 text-gray-600',
    ];
    $labels = [
        'pending'     => 'Pending',
        'in_progress' => 'In Progress',
        'completed'   => 'Completed',
        'cancelled'   => 'Cancelled',
    ];
    $color = $colors[$status] ?? 'bg-gray-100 text-gray-600';
    $label = $labels[$status] ?? ucfirst($status);
@endphp

<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $color }}">
    {{ $label }}
</span>