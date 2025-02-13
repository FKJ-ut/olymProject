<div class="rounded-lg shadow-md mb-4 p-4">
    <h3 class="text-lg font-semibold mb-4 text-white">Title</h3>
    <h3 class="bg-white font-bold text-lg mb-2">{{ $title }}</h3><br>
    <h3 class="text-lg font-semibold mb-4 text-white">Original Question</h3>
    <h4 class="bg-white">{!! $content !!}</h4><br>
    <h3 class="text-lg font-semibold mb-4 text-white">Translated Question</h3>

    <div class="bg-white rounded-lg shadow-md mb-4 p-4">
        <div class="row">
            <div class="col">
                <textarea name="content" id="editor" class="w-100"></textarea>
            </div>
        </div>
    </div>
    <button type="submit"
        class= "text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">Save Translation
    </button>
    <a href="{{ route('translation.AI', ['question_id' => $question->id]) }}" class="btn btn-primary text-white">
        AI Translation
    </a>
</div>
