<!-- resources/views/student/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl text-gray-800 leading-tight">
            Create New Student
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('student.store') }}" class="w-full max-w-lg">
                @csrf

                <div class="mb-4">
                    <label for="delegation_id" class="font-semibold text-4xl text-white text-center mb-4">Delegation</label>
                    <select id="delegation_id" name="delegation_id" class="form-select w-full @error('delegation_id') border-red-500 @enderror" required>
                        <option value="">Select a Delegation</option>
                        @foreach($delegations as $delegation)
                            <option value="{{ $delegation->id }}" {{ old('delegation_id') == $delegation->id ? 'selected' : '' }}>{{ $delegation->name }}</option>
                        @endforeach
                    </select>
                    @error('delegation_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="name" class="font-semibold text-4xl text-white text-center mb-4">Name</label>
                    <input id="name" type="text" name="name" class="form-input w-full @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Create Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
