<nav x-data="{ open: false }"
     class="sticky top-0 z-50 border-b border-white/10 bg-[#07090b]/80 backdrop-blur-xl">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-20">

            {{-- LEFT --}}
            <div class="flex items-center gap-10">

                {{-- LOGO --}}
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 group">

                    <div class="w-3 h-3 rounded-full bg-lime-300 shadow-[0_0_20px_rgba(190,242,100,0.9)] group-hover:scale-110 transition">
                    </div>

                    <span class="text-2xl font-black tracking-tight text-white"
                          style="font-family: 'Syne', sans-serif;">
                        TaskFlow
                        <span class="text-lime-300">Pro</span>
                    </span>
                </a>

                {{-- DESKTOP NAV --}}
                <div class="hidden sm:flex items-center gap-1">

                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ request()->routeIs('dashboard')
                            ? 'bg-white/10 text-white border border-white/10'
                            : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                        Dashboard
                    </a>

                    <a href="#"
                       class="px-4 py-2 rounded-full text-sm font-medium text-zinc-400 hover:text-white hover:bg-white/5 transition">
                        Tasks
                    </a>

                    <a href="#"
                       class="px-4 py-2 rounded-full text-sm font-medium text-zinc-400 hover:text-white hover:bg-white/5 transition">
                        Reports
                    </a>

                </div>
            </div>

            {{-- RIGHT --}}
            <div class="hidden sm:flex items-center gap-4">

                {{-- USER DROPDOWN --}}
                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">

                        <button class="group flex items-center gap-3 px-3 py-2 rounded-full border border-white/10 bg-white/5 hover:bg-white/10 transition">

                            {{-- AVATAR --}}
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-lime-300 to-lime-500 flex items-center justify-center text-black text-sm font-bold shadow-lg">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="text-left">
                                <p class="text-sm font-semibold text-white leading-tight">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="text-xs text-zinc-400 leading-tight">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>

                            <svg class="w-4 h-4 text-zinc-400 group-hover:text-white transition"
                                 fill="currentColor"
                                 viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd" />
                            </svg>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <div class="bg-[#111316] border border-white/10 rounded-2xl overflow-hidden shadow-2xl">

                            <x-dropdown-link :href="route('profile.edit')"
                                class="text-zinc-300 hover:bg-white/5 hover:text-white transition">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link
                                    :href="route('logout')"
                                    class="text-red-400 hover:bg-red-500/10 hover:text-red-300 transition"
                                    onclick="event.preventDefault();
                                             this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>

                        </div>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- MOBILE MENU BUTTON --}}
            <div class="flex items-center sm:hidden">

                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-xl text-zinc-400 hover:text-white hover:bg-white/5 transition">

                    <svg class="h-6 w-6"
                         stroke="currentColor"
                         fill="none"
                         viewBox="0 0 24 24">

                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open"
         x-transition
         class="sm:hidden border-t border-white/10 bg-[#07090b]/95 backdrop-blur-xl">

        <div class="px-4 py-4 space-y-2">

            <x-responsive-nav-link :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
                class="text-zinc-300 hover:text-white">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link href="#"
                class="text-zinc-300 hover:text-white">
                Tasks
            </x-responsive-nav-link>

            <x-responsive-nav-link href="#"
                class="text-zinc-300 hover:text-white">
                Reports
            </x-responsive-nav-link>

        </div>

        {{-- MOBILE USER --}}
        <div class="border-t border-white/10 px-4 py-4">

            <div class="mb-4">
                <div class="text-base font-semibold text-white">
                    {{ Auth::user()->name }}
                </div>

                <div class="text-sm text-zinc-400">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="space-y-2">

                <x-responsive-nav-link :href="route('profile.edit')"
                    class="text-zinc-300 hover:text-white">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        class="text-red-400 hover:text-red-300"
                        onclick="event.preventDefault();
                                 this.closest('form').submit();">

                        Log Out

                    </x-responsive-nav-link>
                </form>

            </div>

        </div>

    </div>
</nav>