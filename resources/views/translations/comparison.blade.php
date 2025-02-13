<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight mb-4">
            Translation Comparison for Question {{ $questionTranslation->question->title }}
        </h2>

        <div class="mt-6 flex space-x-4">
            <form action="{{ route('translations.update', ['questionTranslationId' => $questionTranslation->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="content" value="{{$newTranslation}}">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Accept Changes
                </button>
            </form>
            <a href="{{ route('question-translation.editor', ['questionTranslation' => $questionTranslation->id]) }}"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                Reject Changes
            </a>
        </div>
    </x-slot>

    <div class="mx-auto mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 w-[80%]">            <!-- Original Translation -->
            <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-white mb-2">Original Translation</h3>
                <textarea id="editorOriginal" class="w-full h-40 bg-black text-white p-2 rounded" readonly>{!! $originalTranslation !!}</textarea>
            </div>

            <!-- New Translation -->
            <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-white mb-2">New Translation</h3>
                <textarea id="editorNew" class="w-full h-40 bg-black text-white p-2 rounded" readonly>{!! $newTranslation !!}</textarea>
            </div>

            <!-- Comparisons and Suggestions -->
            <div class="bg-gray-800 p-4 rounded-lg shadow-md mt-6">
                <h3 class="text-xl font-semibold text-white mb-2">Comparisons & Suggestions</h3>
                <div class="bg-black text-white p-2 rounded" style="white-space: pre-wrap;">
                    {!! nl2br(e($comparisons)) !!}
                </div>
            </div>
        </div>

        <!-- Decision Section -->

    </div>

    <!-- CKEditor Scripts -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor for the original translation (read-only mode)
        ClassicEditor
            .create(document.querySelector('#editorOriginal'))
            .then(editor => {
                editor.enableReadOnlyMode('editorOriginal'); // Set read-only mode
            })
            .catch(error => {
                console.error(error);
            });

        // Initialize CKEditor for the new translation (read-only mode)
        ClassicEditor
            .create(document.querySelector('#editorNew'))
            .then(editor => {
                editor.enableReadOnlyMode('editorNew'); // Set read-only mode
                // Update hidden input field with new translation content before form submission
                document.querySelector('#translationForm').addEventListener('submit', function() {
                    document.querySelector('#hiddenNewTranslation').value = editor.getData();
                });
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>

</x-app-layout>
