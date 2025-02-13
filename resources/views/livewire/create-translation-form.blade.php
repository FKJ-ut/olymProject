<div class="bg-gray-800 p-6 rounded-lg">
    <form wire:submit.prevent="submitForm">
        <!-- Error messages -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Language field -->
        <div class="mb-4">
            <label for="language" class="block text-gray-300 text-sm font-bold mb-2">Language</label>
            <input type="text" wire:model.defer="language" id="language"
                class="form-input bg-white text-black rounded-md shadow-sm mt-1 w-full" required />
        </div>

        <!-- Delegation field -->
        <div class="mb-4">
            <label for="delegation" class="block text-gray-300 text-sm font-bold mb-2">Delegation</label>
            <select wire:model.defer="delegationId" id="delegation"
                class="form-select bg-gray-700 text-gray-300 rounded-md shadow-sm mt-1 w-full" required>
                <option value="">Select Delegation</option>
                @foreach ($delegations as $delegation)
                    <option value={{ $delegation->id }}>{{ $delegation->name }}</option>
                @endforeach
            </select>
        </div>



        <!-- Submit button -->
        <button type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Create
            Translation</button>
    </form>
</div>
