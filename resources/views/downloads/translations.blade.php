<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Download Examination Papers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h2 class="font-semibold text-4xl text-white text-center mb-4">
            Select Language
        </h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Display Translations Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($translations->count() > 0)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <!-- Table header -->
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Delegation Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Language</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($translations as $translation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $translation->delegation->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-black">{{ $translation->language }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <!-- Buttons for actions -->
                                            <a href="{{ route('downloads.sections', ['translationId' => $translation->id]) }}"
                                                class="bg-blue-500 hover:bg-blue-600 text-black font-semibold py-2 px-4 rounded-lg">View
                                                Sections</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="p-6 bg-white border-b border-gray-200 text-center">No translations found</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
