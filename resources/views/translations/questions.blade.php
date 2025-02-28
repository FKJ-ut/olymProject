<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ $translation->language }} Translations for {{ $section->title }} Section
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:translation-question-list :translation="$translation" :section="$section" />
        </div>
    </div>
</x-app-layout>
