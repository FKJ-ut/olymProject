<!-- resources/views/students/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl text-gray-800 leading-tight">
            Students List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Students Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delegation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serial Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($students as $student)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->delegation->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->serialNo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 font-bold py-2 px-4 rounded text-black focus:outline-none focus:shadow-outline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Create Student Button -->
            <div class="mt-4">
                <a href="{{ route('student.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add New Student
                </a>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="bg-white mt-4 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
</x-app-layout>
