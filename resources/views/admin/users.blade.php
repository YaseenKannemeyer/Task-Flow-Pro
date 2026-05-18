@extends('layouts.app')

@section('title', 'Users Management')

@section('content')

<div class="py-6 space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Users Management</h1>
            <p class="text-sm text-gray-500">Manage system users and permissions</p>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="bg-white shadow-sm border rounded-xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="text-left px-6 py-3">Name</th>
                        <th class="text-left px-6 py-3">Email</th>
                        <th class="text-left px-6 py-3">Role</th>
                        <th class="text-left px-6 py-3">Status</th>
                        <th class="text-left px-6 py-3">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @foreach($users as $user)

                        <tr class="hover:bg-gray-50 transition">

                            <!-- NAME -->
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $user->name }}
                            </td>

                            <!-- EMAIL -->
                            <td class="px-6 py-4 text-gray-600">
                                {{ $user->email }}
                            </td>

                            <!-- ROLE -->
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full bg-indigo-50 text-indigo-700">
                                    {{ $user->role->name ?? 'No Role' }}
                                </span>
                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-4">
                                @if($user->is_active)
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        Disabled
                                    </span>
                                @endif
                            </td>

                            <!-- ACTION -->
                            <td class="px-6 py-4">

                                <form method="POST" action="{{ route('admin.users.toggle', $user) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        class="px-3 py-1 text-xs rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">
                                        Toggle Status
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="px-6 py-4 border-t bg-gray-50">
            {{ $users->links() }}
        </div>

    </div>

</div>

@endsection