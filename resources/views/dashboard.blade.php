<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Add this script block in your Blade view -->
    <script>
        function redirectToSection(sectionId) {
            // Redirect to the section page
            window.location.href = '/sections/' + sectionId;
        }
    </script>


    <div class="py-12">

        <h2 class="font-semibold text-4xl text-white text-center mb-4">
            Sections
        </h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Display Sections Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <!-- Table header -->
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($sections as $section)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $section->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $section->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <!-- Buttons for actions -->
                                        <button class="text-indigo-600 hover:text-indigo-900"
                                            onclick="redirectToSection({{ $section->id }})">
                                            View
                                        </button>
                                        @if (Auth::user()->role->name === 'Host' || Auth::user()->role->name === 'Admin')
                                            <form action="{{ route('sections.delete', ['section' => $section->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center">No sections found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Button to Create New Section -->
            @if (Auth::user()->role->name === 'Host' || Auth::user()->role->name === 'Admin')
                <div class="mt-6">
                    <a href="{{ route('create') }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Create New
                        Section</a>
                </div>
            @endif

            <!-- Button to View all students -->
            @if (Auth::user()->role->name === 'Host' || Auth::user()->role->name === 'Admin')
                <div class="mt-6">
                    <a href="{{ route('students.index') }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">View all
                        students</a>
                </div>
            @endif

            <!-- Button to View all delegations -->
            @if (Auth::user()->role->name === 'Host' || Auth::user()->role->name === 'Admin')
                <div class="mt-6">
                    <a href="{{ route('delegations.index') }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">View all
                        delegations</a>
                </div>
            @endif


            @if (Auth::user()->role->name === 'Host')
                <div class="mt-6">
                    <a href="{{ route('users.index') }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Manage
                        Users</a>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="bg-white mt-4 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
