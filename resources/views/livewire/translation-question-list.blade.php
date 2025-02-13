<!-- resources/views/livewire/question-list.blade.php -->

<div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>

            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($questions as $question)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $question->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $question->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $translation1 = $questionTranslations
                                ->where('question_id', $question->id)
                                ->where('translation_id', $translation->id)
                                ->first();
                        @endphp
                        @if ($translation1)
                            Translated
                        @else
                            Untranslated
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($translation1)
                            <button class="text-blue-600 hover:text-blue-900"
                                wire:click="updateTranslation({{ $question->id }})">
                                Update Translation
                            </button><br>
                            <button class="text-red-600 hover:text-red-900"
                                wire:click="deleteTranslation({{ $question->id }})">
                                Delete Translation
                            </button>
                        @else
                            <button class="text-green-600 hover:text-green-900"
                                wire:click="createTranslation({{ $question->id }})">
                                Create New Translation
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

</div>
