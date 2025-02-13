<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl text-gray-800 leading-tight">
            Sections
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm overflow-hidden sm:rounded-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Section Title</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <td class="border px-4 py-2">{{ $section->title }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('moderation.show', ['delegation_id' => $delegation->id, 'section_id' => $section->id]) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
