<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl leading-tight">
            Comments
        </h2>
    </x-slot>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>



    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 bg-gray-200 h-screen p-4">
            <button class="block mb-2 text-white">Comments</button>
            <button class="block text-white">History</button>
        </div>

        <!-- Split layout -->
        <div class="w-3/4 p-4">
            <h3 class="text-lg font-semibold mb-4 text-white">Header</h3>
            <!-- Display the current title -->
            <p class="text-white">{{ $question->title }}</p>

            <!-- Display the current content -->
            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content</label>
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
        </div>
    </div>
</x-app-layout>
