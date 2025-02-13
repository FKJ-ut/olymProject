<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl leading-tight">
            Categorized Comments
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Display the categorized content -->
        <div class="bg-white p-6 rounded shadow-md">
            <h3 class="text-xl font-semibold mb-4">Summary of Comments</h3>

            <!-- Display the entire content passed from the controller -->
            <div class="whitespace-pre-wrap">
                {!! nl2br(e($content)) !!}
            </div>
        </div>
    </div>
</x-app-layout>
