<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white font-semibold text-xl text-gray-800 leading-tight">
            Upload Submission
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('submissions.store') }}" enctype="multipart/form-data" class="w-full max-w-lg">
                @csrf

                <div class="mb-4">
                    <label for="student_id" class="font-semibold text-4xl text-white text-center mb-4">Student</label>
                    <select id="student_id" name="student_id" class="form-select w-full @error('student_id') border-red-500 @enderror" required>
                        <option value="">Select a student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->serialNo }})</option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="section_id" class="font-semibold text-4xl text-white text-center mb-4">Section</label>
                    <select id="section_id" name="section_id" class="form-select w-full @error('section_id') border-red-500 @enderror" required>
                        <option value="">Select a section</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->title }}</option>
                        @endforeach
                    </select>
                    @error('section_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="file" class="font-semibold text-4xl text-white text-center mb-4">PDF File</label>
                    <input id="file" type="file" name="file" class="form-input w-full @error('file') border-red-500 @enderror" accept=".pdf" required>
                    @error('file')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
