<!-- resources/views/comments/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl leading-tight">
            Create Comment
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <form action="{{ route('comments.store', ['question' => $question_id]) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                <textarea name="content" id="content" class="form-textarea w-full @error('content') border-red-500 @enderror"
                    rows="5" required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Comment
            </button>
        </form>


    </div>
</x-app-layout>
