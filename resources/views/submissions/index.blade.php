<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Submissions
        </h2>
    </x-slot>

    <!-- Table -->
    <table class="table" style="background-color: white; color: black; width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="background-color: #f8f9fa; color: black; padding: 8px; border: 1px solid #dee2e6;">Exam</th>
                <th style="background-color: #f8f9fa; color: black; padding: 8px; border: 1px solid #dee2e6;">Delegation</th>
                <th style="background-color: #f8f9fa; color: black; padding: 8px; border: 1px solid #dee2e6;">Serial Number</th>
                <th style="background-color: #f8f9fa; color: black; padding: 8px; border: 1px solid #dee2e6;">Last Updated</th>
                <th style="background-color: #f8f9fa; color: black; padding: 8px; border: 1px solid #dee2e6;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($submissions as $submission)
                <tr style="background-color: white; color: black; border: 1px solid #dee2e6;">
                    <td style="padding: 8px;">{{ $submission->section->title }}</td>
                    <td style="padding: 8px;">{{ $submission->student->delegation->name }}</td>
                    <td style="padding: 8px;">{{ $submission->student->serialNo }}</td>
                    <td style="padding: 8px;">{{ $submission->updated_at->format('Y-m-d') }}</td>
                    <td style="padding: 8px;">
                        <a href="{{ route('submissions.download', $submission->id) }}" class="btn btn-primary">Download PDF</a>
                        <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Upload PDF button -->
    <div class="mt-4 text-white">
        <a href="{{ route('submissions.upload') }}" class="btn btn-success">Upload Exam Paper</a>
    </div>
</x-app-layout>
