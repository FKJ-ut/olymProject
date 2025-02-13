<!-- resources/views/livewire/vote-poll.blade.php -->

<div>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <h3>{{ $poll->title }}</h3>
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>

                <h4>{{ $poll->description }}</h4>
            </div>
        </div>
    </div>
    <h2 class="font-semibold text-white text-center">
        Vote
    </h2>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">

                    <table class="w-full min-w-full divide-y divide-gray-200 border-collapse">
                        <thead>
                            <tr class="text-center bg-gray-100">
                                <th class="border">Option</th>
                                <th class="border">Votes</th>
                                <th class="border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($options as $index => $option)
                                <tr class="text-center">
                                    <td class="border">{{ $option->name }}</td>
                                    <td class="border">{{ $option->votes }}</td>
                                    <td class="border">
                                        @if ($option->hasVoted(auth()->id()))
                                            <form action="{{ route('unvote', $option->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-black font-bold py-2 px-4 rounded">
                                                    Unvote
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('vote', $option->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-600 text-black font-bold py-2 px-4 rounded">
                                                    Vote
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
