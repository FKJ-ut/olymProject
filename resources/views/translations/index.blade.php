<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Translations') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <h2 class="font-semibold text-4xl text-white text-center mb-4">
            Translations
        </h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Display Translations Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                            @forelse ($translations as $translation)
                            @if(strtoupper($translation->delegation->name) == Auth::user()->team || Auth::user()->role_id == 1)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $translation->delegation->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $translation->language }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-black">
                                        <!-- Buttons for actions -->
                                        <a href="{{ route('translation.sections', ['translationId' => $translation->id]) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-black font-semibold py-2 px-4 rounded-lg">View
                                            Sections</a>
                                        @if (Auth::user()->role->name === 'Admin')
                                            <form action="{{ route('translations.destroy', ['translation' => $translation->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-black hover:text-red-900 ml-4">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @empty


                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center">No translations
                                        found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Button to Create New Translation -->
            @if (Auth::user()->role->name === 'Admin' || Auth::user()->role->name === 'Host')
                <div class="mt-6">
                    <a href="{{ route('translation.create') }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Create New
                        Translation</a>
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
