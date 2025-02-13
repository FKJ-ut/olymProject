<!-- resources/views/users/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center justify-start mb-4 ml-4">
            <a href="{{ route('dashboard') }}" class="text-white hover:text-gray-300 mr-4" style="font-size: 24px;">
                &lt;
            </a>
        </h1>

        <h2 class="font-semibold text-xl text-white leading-tight">
            Manage Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Delegation</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role</th>
                                <!-- New Column Headers -->
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->team }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->role->name }}</td>
                                    <!-- Manage Button -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" class="text-blue-500 hover:text-blue-700">Manage</a>
                                    </td>
                                    <!-- Delete Button -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-6">
                        <a href="{{ route('users.create') }}"
                            class="bg-green-500 hover:bg-green-600 text-black font-semibold py-2 px-4 rounded-lg">Create
                            New User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
