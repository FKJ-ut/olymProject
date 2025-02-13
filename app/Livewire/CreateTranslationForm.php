<?php

namespace App\Livewire;

use App\Models\Delegation;
use App\Models\Translation;
use Livewire\Component;

class CreateTranslationForm extends Component
{
    public $delegations;
    public $delegationId;
    public $language;

    public function mount()
    {
        // Fetch all delegations and assign them to the $delegations property
        $this->delegations = Delegation::all();
    }

    public function submitForm()
    {

        // Validate form inputs
        $validatedData = $this->validate([
            'language' => 'required|string',
            'delegationId' => '',
        ], [
            'delegationId.required' => 'The delegation field is required.',
            'delegationId.exists' => 'The selected delegation is invalid.',
        ]);

        // Create a new translation and associate it with the delegation
        Translation::create([
            'language' => $validatedData['language'],
            'delegation_id' => $validatedData['delegationId'],
        ]);

        // Redirect or show success message
        // ...
        return redirect()->route('translation.index')->with('success', 'Translation created successfully.');

    }

    public function render()
    {
        // Fetch delegations data
        $delegations = Delegation::all();

        return view('livewire.create-translation-form', ['delegations' => $delegations]);
    }
}
