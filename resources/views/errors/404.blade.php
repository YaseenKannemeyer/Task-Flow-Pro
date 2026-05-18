@extends('layouts.app')
@section('title', '404 Not Found')
@section('content')
<div class="flex flex-col items-center justify-center py-32 text-center">
    <h1 class="text-6xl font-bold text-gray-200 mb-4">404</h1>
    <p class="text-xl font-semibold text-gray-700 mb-2">Page Not Found</p>
    <p class="text-gray-400 mb-6">The page you're looking for doesn't exist or has been moved.</p>
    <a href="{{ route('dashboard') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
        Back to Dashboard
    </a>
</div>
@endsection