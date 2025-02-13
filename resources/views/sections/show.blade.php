<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl leading-tight">
            {{ $section->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                    Descriptions</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($questions as $question)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $question->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $question->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('questions.editor', ['question' => $question->id]) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Edit Question</a><br>
                                        <a href="{{ route('questions.editor', ['question' => $question->id]) }}"
                                            class="text-indigo-600 hover:text-indigo-900">View Question</a><br>
                                        <form method="POST"
                                            action="{{ route('questions.destroy', ['question' => $question->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center">No questions
                                        found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('questions.create', ['section' => $section->id]) }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Create New
                    Question</a>
            </div>
            @if (session()->has('success'))
                <div class="bg-white mt-4  border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
