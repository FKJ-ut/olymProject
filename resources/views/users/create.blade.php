<!-- resources/views/users/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center justify-start mb-4 ml-4">
            <a href="{{ route('users.index') }}" class="text-white hover:text-gray-300 mr-4" style="font-size: 24px;">
                &lt;
            </a>
        </h1>

        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                Create New User
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="max-w-7xl mx-auto bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control rounded-md shadow-sm mt-1 w-full" value="{{ old('name') }}" required
                            autofocus />
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control rounded-md shadow-sm mt-1 w-full" value="{{ old('email') }}"
                            required />
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control rounded-md shadow-sm mt-1 w-full" required />
                    </div>

                    <div class="mb-4">
                        <label for="team" class="block text-gray-700 text-sm font-bold mb-2">Delegation</label>
                        <input type="text" name="team" id="team"
                            class="form-control rounded-md shadow-sm mt-1 w-full" value="{{ old('team') }}"
                            required />
                    </div>

                    @if (Auth::user()->role->name === 'Admin')
                        <div class="mb-4">
                            <label for="role_id" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                            <select name="role_id" id="role" class="form-select rounded-md shadow-sm mt-1 w-full">
                                <option value="3">Leader</option>
                                <option value="4">Examiner</option>
                            </select>
                        </div>
                    @elseif (Auth::user()->role->name === 'Host')
                        <div class="mb-4">
                            <label for="role_id" class="block text-gray-700 text-sm font-bold mb-2">role_id</label>
                            <select name="role_id" id="role_id" class="form-select rounded-md shadow-sm mt-1 w-full">
                                <option value="2">Admin</option>
                                <option value="3">Leader</option>
                                <option value="4">Examiner</option>
                            </select>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        Create User
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
                    <div class="bg-white mt-4  border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role_id="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
