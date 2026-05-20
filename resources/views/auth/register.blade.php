<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Card wrapper feel --}}
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">

            {{-- Title --}}
            <h2 class="text-xl font-bold text-slate-900 mb-1">Create Account</h2>
            <p class="text-sm text-slate-500 mb-6">Join TaskFlow Pro and start managing tasks</p>

            <!-- Name -->
            <div>
                <x-input-label for="name" value="Full Name" class="text-slate-700" />
                <x-text-input id="name"
                    name="name"
                    type="text"
                    required
                    class="block mt-1 w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" value="Email Address" class="text-slate-700" />
                <x-text-input id="email"
                    name="email"
                    type="email"
                    required
                    class="block mt-1 w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm" />
            </div>

            <!-- Role -->
            <div class="mt-4">
                <x-input-label for="role_id" value="Role" class="text-slate-700" />

                <select name="role_id"
                    class="block mt-1 w-full rounded-xl border-slate-200 text-slate-700 focus:border-blue-500 focus:ring-blue-500 shadow-sm">

                    <!-- <option value="1">Admin (TEMP)</option> -->
                    <option value="2">Member</option>
                    <option value="3">Guest</option>

                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="Password" class="text-slate-700" />
                <x-text-input id="password"
                    name="password"
                    type="password"
                    required
                    class="block mt-1 w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" value="Confirm Password" class="text-slate-700" />
                <x-text-input id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    class="block mt-1 w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm" />
            </div>

            <!-- Button -->
            <div class="mt-6">
                <x-primary-button
                    class="w-full justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl shadow-sm transition">
                    Register
                </x-primary-button>
            </div>

        </div>
    </form>
</x-guest-layout>