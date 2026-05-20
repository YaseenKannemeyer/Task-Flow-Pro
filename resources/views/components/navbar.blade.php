<nav class="bg-white border-b border-slate-100 px-4 sm:px-6 py-3.5 flex items-center justify-between sticky top-0 z-40 backdrop-blur-md bg-white/95">
    
    {{-- Left Section: Brand Logo --}}
    <div class="flex items-center gap-2">
        <a href="{{ route('dashboard') }}" class="group flex items-center gap-2.5 text-xl font-extrabold tracking-tight text-slate-900">
            <span class="flex items-center justify-center w-8 h-8 rounded-xl bg-blue-600 text-white shadow-sm shadow-blue-500/20 group-hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </span>
            <span>Task<span class="text-blue-600">Flow Pro</span></span>
        </a>
    </div>

    {{-- Right Section: Actions & User Meta --}}
    <div class="flex items-center gap-4">
        
        <a href="{{ route('tasks.assigned') }}"
   class="relative p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-xl transition-all duration-200">

    <span class="absolute top-2.5 right-2.5 w-2 h-2 rounded-full bg-blue-500 ring-2 ring-white"></span>

    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.437L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
    </svg>
</a>

        {{-- Vertical Visual Divider --}}
        <span class="h-5 w-px bg-slate-200 hidden sm:block"></span>

        {{-- AlpineJS Dropdown --}}
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" 
                    class="flex items-center gap-2.5 p-1.5 pr-3 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-all duration-200 text-left">
                
                <!-- Avatar block match with dashboard table standards -->
                <span class="w-8 h-8 rounded-xl bg-blue-50 border border-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs uppercase shadow-sm">
                    {{ Auth::user()->initials }}
                </span>
                
                <!-- Name string display container -->
                <div class="hidden md:flex flex-col">
                    <span class="text-sm font-semibold text-slate-800 leading-none">{{ Auth::user()->name }}</span>
                    <span class="text-[11px] text-slate-400 font-medium mt-0.5">Workspace Member</span>
                </div>

                <!-- Dropdown Arrow Icon Indicator -->
                <svg class="w-4 h-4 text-slate-400 hidden md:block transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            {{-- Dropdown Floating panel --}}
            <div x-show="open" 
                 @click.outside="open = false"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute right-0 mt-2.5 w-52 bg-white border border-slate-100 rounded-2xl shadow-xl z-50 py-1.5 overflow-hidden divide-y divide-slate-50"
                 style="display: none;">
                
                <!-- Conditionally Render Admin Link Profile Option -->
                @if (Auth::user()->isAdmin())
                    <div class="px-1 py-1">
                        <a href="{{ route('admin.index') }}" class="group flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition">
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            Admin Panel
                        </a>
                    </div>
                @endif

                <!-- Form Action Node Option -->
                <div class="px-1 py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="group flex w-full items-center gap-2 px-3 py-2 text-sm font-medium text-rose-600 hover:bg-rose-50 rounded-xl transition">
                            <svg class="w-4 h-4 text-rose-400 group-hover:text-rose-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout Session
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</nav>