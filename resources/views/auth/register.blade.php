<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Full Name" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" value="Email Address" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
        </div>

        <!-- Role (TEMP ADMIN OPTION) -->
<div class="mt-4">
    <x-input-label for="role_id" value="Role" />
    <select name="role_id" class="block mt-1 w-full border-gray-300 rounded">

        <option value="1">Admin (TEMP)</option>
        <option value="2">Member</option>
        <option value="3">Guest</option>

    </select>
</div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
        </div>

        <div class="mt-4">
            <x-primary-button>
                Register
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>