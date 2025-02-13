<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Moderation for {{ $delegation->name }} Students - Section: {{ $section->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form
                    action="{{ route('moderation.saveMarks', ['delegation_id' => $delegation->id, 'section_id' => $section->id]) }}"
                    method="POST">
                    @csrf

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Serial Number</th>
                                @foreach ($questions as $question)
                                    <th class="border px-4 py-2">{{ $question->title }}</th>
                                @endforeach
                                <th class="border px-4 py-2">Total Marks</th>
                                <th class="border px-4 py-2">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td class="border px-4 py-2">{{ $student->serialNo }}</td>

                                    @php
                                        $totalMarks = 0;
                                    @endphp

                                    @foreach ($questions as $question)
                                        <td class="border px-4 py-2">
                                            <!-- Display the current marks for this student-question combination -->
                                            <input type="number" name="marks[{{ $student->id }}][{{ $question->id }}]"
                                                value="{{ $student->getMarksForQuestion($student->id, $question->id) ?? 0 }}"
                                                step="0.5" class="form-input w-full">
                                        </td>

                                        @php
                                        $totalMarks += $student->getMarksForQuestion($student->id, $question->id);
                                        @endphp

                                    @endforeach

                                    <td class="border px-4 py-2">
                                        {{ $totalMarks }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        <input type="checkbox" name="students[]" value="{{ $student->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            Save Marks
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
