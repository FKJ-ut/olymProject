<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl text-gray-800 leading-tight">
            Editor
        </h2>
    </x-slot>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>



    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 bg-black h-screen p-4">
            <a href="{{ route('questions.editor', ['question' => $question->id]) }}" class="block text-white">Editor</a>
            <a href="{{ route('questions.logs', ['question' => $question->id]) }}" class="block text-white">History</a>
        </div>

        <!-- Split layout -->
        <div class="w-3/4 p-4">
            <h3 class="text-lg font-semibold mb-4 text-white">Title</h3>
            <form action="{{ route('questions.updateTitle', ['question' => $question->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <input id="title" type="text" name="title"
                        class="form-input w-full @error('title') border-red-500 @enderror"
                        value="{{ old('title', $question->title) }}" required>
                    @error('title')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-start">
                    <button type="submit"
                        class="btn btn-primary font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
                        Update Title
                    </button><br>
                </div>
            </form>
            <h3 class="text-lg font-semibold mb-4 text-white">Content</h3>
            <!-- Text editor -->
            <form action="{{ route('questions.save-content', ['questionId' => $question->id]) }}" method="POST">
                @csrf
                <textarea name="content" id="editor">{{ $question->content }}</textarea>
                <button type="submit"
                    class= "btn btn-primary font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">Save
                    Content</button>
            </form><br>
            <a href="{{ route('questions.generate-pdf', ['id' => $question->id]) }}" class="btn btn-secondary text-white"
                onclick="return confirm('Are you sure you want to generate the PDF?')">
                Generate PDF
            </a>
            <script>
                ClassicEditor
                    .create(document.querySelector('#editor')).create(document.querySelector('#editor'), {
                        toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'imageUpload'],
                        ckfinder: {
                            uploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}', // Laravel route to handle uploads
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>
        </div>

        <div class="w-3/4 p-4">
            @if ($question->file_path)
                <h3 class="text-lg font-semibold mb-4 text-white">Preview</h3>
                <!-- PDF preview -->
                    <!-- Embed the PDF -->
                    <iframe src="{{ asset($question->file_path) }}" width="100%" height="600px"
                        frameborder="0"></iframe>

            @endif
        </div>
</x-app-layout>
