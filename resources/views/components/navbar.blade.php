<nav class="bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between shadow-sm">
    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-indigo-600">
        &#x2713; TaskFlow
    </a>

    {{-- Right: user menu --}}
    <div class="flex items-center gap-4">
        {{-- Notification bell --}}
        <a href="#" class="relative text-gray-500 hover:text-indigo-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.437L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
        </a>

        {{-- User avatar / dropdown --}}
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-2 text-sm text-gray-700 hover:text-indigo-600">
                <span class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-semibold text-xs">
                    {{ Auth::user()->initials }}
                </span>
                <span class="hidden md:block">{{ Auth::user()->name }}</span>
            </button>
            <div x-show="open" @click.outside="open = false"
                 class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                
                @if (Auth::user()->isAdmin())
                    <a href="{{ route('admin.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Admin Panel</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>