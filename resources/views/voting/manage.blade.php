<!-- resources/views/polls/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">{{ __('Manage Poll') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <livewire:UpdatePoll :poll="$poll" />

        </div>
    </div>
    </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
