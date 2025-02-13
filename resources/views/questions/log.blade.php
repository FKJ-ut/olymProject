<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl text-gray-800 leading-tight">
            Logs
        </h2>
    </x-slot>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>

    <div class="container-fluid">
        <div class="d-flex flex-row">
            <!-- Sidebar -->
            <div class="bg-gray-200 p-4">
                <a href="{{ route('questions.editor', ['question' => $question->id]) }}" class="block text-white">Editor</a>
                <a href="{{ route('questions.logs', ['question' => $question->id]) }}" class="block text-white">History</a>
            </div>

            <!-- Logs Content -->
            <div class="flex-grow-1">
                <div class="container">
                    <h1 style="color: white;">Logs for Question: {{ $question->title }}</h1>
                    <table class="table" style="background-color: #333; color: white; border: 1px solid #555; border-collapse: collapse; width: 100%;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #555; padding: 8px;">User</th>
                                <th style="border: 1px solid #555; padding: 8px;">Operation</th>
                                <th style="border: 1px solid #555; padding: 8px;">Original Content</th>
                                <th style="border: 1px solid #555; padding: 8px;">Updated Content</th>
                                <th style="border: 1px solid #555; padding: 8px;">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td style="border: 1px solid #555; padding: 8px;">{{ $log->user->name }}</td>
                                    <td style="border: 1px solid #555; padding: 8px;">{{ $log->operation }}</td>
                                    <td style="border: 1px solid #555; padding: 8px;">{!! $log->original_content !!}</td>
                                    <td style="border: 1px solid #555; padding: 8px;">{!! $log->updated_content !!}</td>
                                    <td style="border: 1px solid #555; padding: 8px;">{{ $log->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
