<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Downloads for {{ $translation->language }} translation examination papers
        </h2>
    </x-slot>

    <div class="py-12">

        <h2 class="font-semibold text-4xl text-white text-center mb-4">
            {{ $translation->language }} Sections
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
                                        <!-- Download PDF button -->
                                        <a href="{{ route('downloads.downloadPdf', ['translationId' => $translation->id, 'sectionId' => $section->id]) }}"
                                            class="text-black hover:text-indigo-900">
                                            Download PDF
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No sections available.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
