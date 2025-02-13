<!-- resources/views/sections/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl leading-tight">
            Create New Section
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('sections.store') }}" class="w-full max-w-lg">
                @csrf

                <div class="mb-4">
                    <label for="title" class="font-semibold text-4xl text-white text-center mb-4">Title</label>
                    <input id="title" type="text" name="title"
                        class="form-input w-full @error('title') border-red-500 @enderror" value="{{ old('title') }}"
                        required autofocus>
                    @error('title')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description"
                        class="font-semibold text-4xl text-white text-center mb-4">Description</label>
                    <textarea id="description" name="description"
                        class="form-textarea w-full @error('description') border-red-500 @enderror" rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Create Section
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
