<!-- resources/views/delegations/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center justify-start mb-4 ml-4">
            <a href="{{ route('delegations.index') }}" class="text-white hover:text-gray-300 mr-4" style="font-size: 24px;">
                &lt;
            </a>
        </h1>

        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                Create New Delegation
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="max-w-7xl mx-auto bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('delegations.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control rounded-md shadow-sm mt-1 w-full" value="{{ old('name') }}" required
                            autofocus />
                    </div>

                    <div class="mb-4">
                        <label for="tag" class="block text-gray-700 text-sm font-bold mb-2">Tag</label>
                        <input type="text" name="tag" id="tag"
                            class="form-control rounded-md shadow-sm mt-1 w-full" value="{{ old('tag') }}"
                            maxlength="3" required />
                        <p class="text-xs text-gray-500">Maximum 3 characters</p>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Create Delegation
                    </button>

                    @if ($errors->any())
                        <div class="mt-4">
                            <ul class="list-disc list-inside text-red-500">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>

                @if (session()->has('success'))
                    <div class="bg-white mt-4 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
