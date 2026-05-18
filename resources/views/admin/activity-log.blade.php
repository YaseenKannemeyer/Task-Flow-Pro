<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Activity Log
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left">
                            <th>User</th>
                            <th>Action</th>
                            <th>Subject</th>
                            <th>Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($logs as $log)
                            <tr class="border-b">
                                <td class="py-2">
                                    {{ $log->user->name ?? 'System' }}
                                </td>

                                <td>
                                    {{ ucfirst($log->action) }}
                                </td>

                                <td>
                                    {{ $log->subject_type }} #{{ $log->subject_id }}
                                </td>

                                <td>
                                    {{ $log->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $logs->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>