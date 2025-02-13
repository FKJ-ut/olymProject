<!-- resources/views/polls/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Vote Poll</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <livewire:VotePoll :poll="$poll" />
        </div>
    </div>
    </div>
    </div>
</x-app-layout>
