<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Comments') }}        
        </h2>
    </x-slot>

<!-- Add this script block in your Blade view -->
<script>
    function redirectToSection(sectionId) {
        // Redirect to the section page
        window.location.href = '/comments/' + sectionId;
    }
</script>

    
    <div class="py-12">
    <h2 class="font-semibold text-4xl text-white text-center mb-4">
    Sections
    </h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Display Sections Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <!-- Table header -->
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="bg-white divide-y divide-gray-200">
    @forelse ($sections as $section)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $section->title }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $section->description }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <!-- Buttons for actions -->
                <button class="text-indigo-600 hover:text-indigo-900" onclick="redirectToSection({{ $section->id }})">
    View Questions
</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center">No sections found</td>
        </tr>
    @endforelse
</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
