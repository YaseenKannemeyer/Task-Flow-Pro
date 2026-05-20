<aside class="w-64 min-h-screen bg-white border-r border-slate-100 p-4 flex flex-col gap-1">

    {{-- Section Label --}}
   

      @if (Auth::user()->isAdmin())
                     <p class="px-3 text-xs text-slate-400 uppercase tracking-wider mb-2">
        Admin
    </p>
                @endif

    {{-- Dashboard --}}
    <a href="{{ route('dashboard') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
              {{ request()->routeIs('dashboard')
                ? 'bg-blue-50 text-blue-700 border border-blue-100'
                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
        
        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>

        Dashboard
    </a>

    {{-- Tasks --}}
    <a href="{{ route('tasks.index') }}"
       class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
              {{ request()->routeIs('tasks.index')
                ? 'bg-blue-50 text-blue-700 border border-blue-100'
                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
        
        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>

        Tasks
    </a>

    {{-- Categories --}}
    @can('manage-tasks')
        <a href="{{ route('categories.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
                  {{ request()->routeIs('categories.*')
                    ? 'bg-blue-50 text-blue-700 border border-blue-100'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">

            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>

            Categories
        </a>

        {{-- Create Task --}}
        <a href="{{ route('tasks.create') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
                  {{ request()->routeIs('tasks.create')
                    ? 'bg-blue-50 text-blue-700 border border-blue-100'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">

            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>

            Create Task
        </a>
    @endcan

    {{-- Admin Section --}}
    @can('access-admin')
        <div class="my-2 border-t border-slate-100"></div>

        <a href="{{ route('admin.users') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
                  text-slate-600 hover:bg-slate-50 hover:text-slate-900">

            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>

            Manage Users
        </a>

        <a href="{{ route('admin.reports') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
                  text-slate-600 hover:bg-slate-50 hover:text-slate-900">

            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>

            Reports
        </a>
    @endcan
</aside>