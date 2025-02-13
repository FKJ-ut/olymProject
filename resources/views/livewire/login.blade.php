
<div id="options-container">
    @for ($i = 0; $i < $numOptions; $i++)
        <div class="option mb-4">
            <input type="text" wire:model="options.{{ $i }}"
                class="form-input rounded-md shadow-sm mt-1 w-full" placeholder="Option Name" required />
            <button type="button" class="btn-delete-option" wire:click="removeOption({{ $i }})">Delete</button>
        </div>
    @endfor
</div>
