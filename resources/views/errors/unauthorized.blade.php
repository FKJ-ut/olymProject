<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Unauthorized Access
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <h1 class="text-2xl font-bold text-red-500">You are not authorized to access this page.</h1>
                    <p class="mt-4 text-gray-600">Please return to the dashboard or contact the administrator/host for more information.</p>

                    <a href="{{ route('dashboard') }}" class="inline-block mt-6 px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
