<div class="min-h-screen bg-gray-900 p-6">
    <!-- Header -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight mb-6">
            {{ $language }} Translation for Question {{ $question->title }} of {{ $sectionName }}
        </h2>
    </x-slot>

    <div class="flex flex-col lg:flex-row lg:space-x-6">
        <!-- Sidebar -->
        <aside class="lg:w-1/4 bg-gray-800 p-6 rounded-lg shadow-lg mb-6 lg:mb-0">
            <!-- Editor Button -->
            <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg mb-2">
                Editor
            </button>

            <!-- History Button -->
            <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                History
            </button>
        </aside>

        <!-- Main Content -->
        <main class="lg:w-3/4 space-y-6">
            <!-- Question Section -->
            <section class="bg-gray-800 rounded-lg shadow-lg p-6 space-y-6">
                <!-- Title Section -->
                <div>
                    <h3 class="text-xl font-semibold text-white">Question Title</h3>
                    <p class="bg-gray-700 text-lg text-white font-bold p-3 rounded">{{ $question->title }}</p>
                </div>

                <h3 class="text-lg font-semibold text-white">Original Question</h3>
                <textarea id="editor1" class="w-full h-40 p-2 border rounded" readonly>{!! $question->content !!}</textarea>

                <h3 class="text-lg font-semibold text-white">Translated Question</h3>
                <textarea name="content" id="editor2" class="w-full h-40 p-2 border rounded">{!! $questionTranslation->content !!}</textarea>

                <form id="translationForm" action="{{ route('translations.update', ['questionTranslationId' => $questionTranslation->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Hidden Input for New Translation Content -->
                    <input type="hidden" name="content" id="hiddenNewTranslation">

                    <!-- Save Translation Button -->
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-black font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
                        Save Translation
                    </button><br>
                </form>

                <a href="{{ route('AItranslation', ['questionTranslationId' => $questionTranslation->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-black font-bold py-2 px-4 rounded-full focus:outline-none">
                    Generate AI Translation
                </a><br>
                <a href="{{ route('translationPDF', ['id' => $questionTranslation->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none">
                    Generate PDF
                </a><br>
            </section>

            <!-- Translation Section -->
            <section>
                @if($questionTranslation->file_path)
                    <iframe src="{{ asset($questionTranslation->file_path) }}" width="100%" height="600px" frameborder="0"></iframe>
                @else
                    <!-- Optionally display a message or content if file_path is null -->
                    <p>No file available to display.</p>
                @endif
            </section>
        </main>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
<script>
    let editor2Instance;

    // Initialize CKEditor for the first textarea (read-only mode)
    ClassicEditor
        .create(document.querySelector('#editor1'))
        .then(editor => {
            editor.enableReadOnlyMode('editor1'); // Set read-only mode
        })
        .catch(error => {
            console.error(error);
        });

    // Initialize CKEditor for the second textarea (editable)
    ClassicEditor
        .create(document.querySelector('#editor2'))
        .then(editor => {
            editor2Instance = editor; // Save editor instance to use later
        })
        .catch(error => {
            console.error(error);
        });

    // Update hidden input with the content of the editor before form submission
    document.getElementById('translationForm').addEventListener('submit', function() {
        if (editor2Instance) {
            document.getElementById('hiddenNewTranslation').value = editor2Instance.getData();
        }
    });
</script>
