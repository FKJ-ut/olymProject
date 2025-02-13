<!-- resources/views/livewire/poll-form.blade.php -->

<div class="p-6 bg-white border-b border-gray-200">
    <form wire:submit.prevent="submitForm">
        <!-- Error messages -->
        @if ($errors->any())
            <h3>Error:</h3>
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Title field -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" wire:model="title" id="title" class="form-input rounded-md shadow-sm mt-1 w-full"
                required autofocus />
        </div>

        <!-- Description field -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea wire:model="description" id="description" class="form-textarea rounded-md shadow-sm mt-1 w-full"
                rows="3" required></textarea>
        </div>

        <!-- End Time field -->
        <div class="mb-4">
            <label for="end_time" class="block text-gray-700 text-sm font-bold mb-2">End Time (minutes)</label>
            <input type="number" wire:model="end_time" id="end_time"
                class="form-input rounded-md shadow-sm mt-1 w-full" required />
        </div>

        <!-- State field -->
        <div class="mb-4">
            <label for="state" class="block text-gray-700 text-sm font-bold mb-2">State</label>
            <select wire:model="state" id="state" class="form-select rounded-md shadow-sm mt-1 w-full" required>
                <option>Select State</option>
                <option value="live">Live</option>
                <option value="draft">Draft</option>
                <option value="closed">Closed</option>
            </select>
        </div>

        <!-- Options -->
        <div id="options-container">
            @for ($i = 0; $i < $numOptions; $i++)
                <div class="option mb-4">
                    <input type="text" wire:model="options.{{ $i }}"
                        class="form-input rounded-md shadow-sm mt-1 w-full" placeholder="Option Name" required />
                    <button type="button" class="btn-delete-option"
                        wire:click="removeOption({{ $i }})">Delete</button>
                </div>
            @endfor
        </div>
        <!-- Add Option button -->
        <button type="button" class="btn-add-option mb-4" wire:click="addOption">Add Option</button> <br>

        <!-- Submit button -->
        <button type="submit" class="text-black font-semibold py-2 px-4 rounded-lg">Create Poll</button>
    </form>
</div>
