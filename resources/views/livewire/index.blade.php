<!-- resources/views/sections/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Table header -->
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Loop through sections -->
                            @foreach ($sections as $section)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $section->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $section->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <!-- Buttons for actions -->
                                        <a href="#', ['section_id' => $section->id]) }}" class="text-indigo-600 hover:text-indigo-900">View Questions</a>
                                        <a href="#" class="text-red-600 hover:text-red-900 ml-4">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
