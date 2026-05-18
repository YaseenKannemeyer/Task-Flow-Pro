@props(['type' => 'info', 'message' => null])

@php
    $classes = [
        'success' => 'bg-green-50 border-green-300 text-green-800',
        'error'   => 'bg-red-50 border-red-300 text-red-800',
        'warning' => 'bg-yellow-50 border-yellow-300 text-yellow-800',
        'info'    => 'bg-blue-50 border-blue-300 text-blue-800',
    ];
    $class = $classes[$type] ?? $classes['info'];
@endphp

<div class="flex items-start gap-3 border rounded-lg px-4 py-3 mb-4 {{ $class }}" role="alert">
    <svg class="w-5 h-5 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
        @if ($type === 'success')
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        @else
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        @endif
    </svg>
    <div class="text-sm">
        @if ($message)
            {{ $message }}
        @else
            {{ $slot }}
        @endif
    </div>
</div>