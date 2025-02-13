<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl text-gray-800 leading-tight">
            Comments
        </h2>
    </x-slot>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>

    <div class="flex">
        <!-- Left side: Preview -->
        <div class="w-1/2 p-4">
            <h3 class="text-lg font-semibold mb-4 text-white">Header</h3>
            <!-- Display the current title -->
            <p class="text-white">{{ $question->title }}</p>

            <!-- Display the current content -->
            <div class="mb-4">
                <label for="content" class="block text-white text-sm font-bold mb-2">Content</label>
                <textarea name="content" id="editor" contenteditable="false">{{ $question->content }}</textarea>
            </div>
            <script>
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .then(editor => {
                        const toolbarElement = editor.ui.view.toolbar.element;

                        editor.on('change:isReadOnly', (evt, propertyName, isReadOnly) => {
                            if (isReadOnly) {
                                toolbarElement.style.display = 'none';
                            } else {
                                toolbarElement.style.display = 'flex';
                            }
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>
            <a href="{{ route('comments.categorize', ['question_id' => $question->id]) }}" class="btn btn-primary text-white">
                Categorize Comments
            </a>

            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Right side: Comment Section -->
        <div class="w-1/2 bg-slate-800 p-4">
            <h3 class="text-white text-lg font-semibold mb-4">Comments</h3>
            <!-- Display actual comments -->
            <div class="mb-4">
                @foreach ($question->comments->reverse() as $comment)
                    <div class="flex mb-2">
                        <div class="w-12 h-12 bg-gray-400 rounded-full mr-4"></div>
                        <div>
                            <p class="text-white font-semibold">{{ $comment->user->name }}</p>
                            <p class="text-gray-400">{!! $comment->content !!}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <!-- New comment button -->
        <div class="flex justify-end">
            <button onclick="window.location='{{ route('comments.create', ['question_id' => $question->id]) }}'"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Comment
            </button>

        </div>
    </div>
    </div>
</x-app-layout>
