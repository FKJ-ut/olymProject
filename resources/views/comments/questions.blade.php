<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl  leading-tight">
            {{ $section->title }} Comments
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
                                    Description</th>
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
                                        <a href="{{ route('comment.show', ['question' => $question->id]) }}"
                                            class="text-indigo-600 hover:text-indigo-900">View Comments</a>
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

        </div>
    </div>
</x-app-layout>
