<div class="py-12">

    <h2 class="font-semibold text-4xl text-white text-center mb-4">
        {{ $translation->language }} Translations
    </h2>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Display Sections Table -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <!-- Table header -->
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
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
                                    <a href="{{ route('translations.questions', ['translationId' => $translation->id, 'sectionId' => $section->id]) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-black font-semibold py-2 px-4 rounded-lg">View
                                        Questions</a>

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

        @if (session()->has('success'))
            <div class="bg-white mt-4 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
    </div>
</div>
