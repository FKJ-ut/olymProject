<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">{{ __('Voting') }}</h2>
    </x-slot>

    <!-- Add script block for redirection -->
    <script>
        function redirectToSection(sectionId) {
            window.location.href = '/sections/' + sectionId;
        }
    </script>

    @if (session()->has('success'))
        <div class="bg-white mt-4 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Live Polls Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-800 mb-4">Live Polls</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <!-- Table header -->
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created By</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Closes By</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Add table rows for Live Polls -->
                            @foreach ($livePolls as $poll)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $poll->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $poll->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $poll->end_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <a href="{{ route('voting.edit', $poll) }}" class="text-indigo-600 hover:text-indigo-900">Manage Poll</a><br>

                                        <a href="{{ route('voting.show', $poll) }}" class="text-indigo-600 hover:text-indigo-900">View Poll</a><br>

                                        <a href="{{ route('voting.destroy', $poll) }}"
                                            onclick="event.preventDefault(); document.getElementById('delete-poll-{{ $poll->id }}').submit();">
                                            Delete Poll
                                        </a>

                                        <form id="delete-poll-{{ $poll->id }}" action="{{ route('voting.destroy', $poll) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <a href="{{ route('voting.show', $poll) }}" class="text-indigo-600 hover:text-indigo-900">View Poll</a><br>
                                    @endif


                                        <form id="delete-poll-{{ $poll->id }}"
                                            action="{{ route('voting.destroy', $poll) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Draft Polls Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-800 mb-4">Draft Polls</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <!-- Table header -->
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created By</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Closes By</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Add table rows for Draft Polls -->
                            @foreach ($draftPolls as $poll)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $poll->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $poll->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $poll->end_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)

                                        <a href="{{ route('voting.edit', $poll) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Manage Poll</a><br>


                                        <a href="{{ route('voting.destroy', $poll) }}"
                                            onclick="event.preventDefault(); document.getElementById('delete-poll-{{ $poll->id }}').submit();">
                                            Delete Poll
                                        </a>
                                        @endif
                                        <a href="{{ route('voting.show', $poll) }}"
                                        class="text-indigo-600 hover:text-indigo-900">View Poll</a><br>

                                        <form id="delete-poll-{{ $poll->id }}"
                                            action="{{ route('voting.destroy', $poll) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Closed Polls Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-800 mb-4">Closed Polls</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <!-- Table header -->
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created By</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Closes By</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Add table rows for Closed Polls -->
                            @foreach ($closedPolls as $poll)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $poll->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $poll->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $poll->end_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('voting.edit', $poll) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Manage Poll</a><br>

                                        <a href="{{ route('voting.show', $poll) }}"
                                            class="text-indigo-600 hover:text-indigo-900">View Poll</a><br>

                                        <a href="{{ route('voting.destroy', $poll) }}"
                                            onclick="event.preventDefault(); document.getElementById('delete-poll-{{ $poll->id }}').submit();">
                                            Delete Poll
                                        </a>

                                        <form id="delete-poll-{{ $poll->id }}"
                                            action="{{ route('voting.destroy', $poll) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Create New Poll Button -->
            <div class="mt-4">
                <a href="{{ route('createPoll') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Create New
                    Poll</a>
            </div>
        </div>
</x-app-layout>
