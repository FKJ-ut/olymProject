<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl text-gray-800 leading-tight">
            Moderation Tab
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm overflow-hidden sm:rounded-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Delegation</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($delegations as $delegation)
                            @if (strtoupper($delegation->name) == Auth::user()->team || Auth::user()->role_id == 1)
                                <tr>
                                    <td class="border px-4 py-2">{{ $delegation->name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('moderation.sections', $delegation->id) }}"
                                            class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
