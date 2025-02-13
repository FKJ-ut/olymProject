<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PollForm extends Form
{
    public PollForm $form;

    public $title;
    public $description;
    public $end_time;
    public $state;
    public $options = ['']; // Initial empty option

    public function addOption()
    {
        $this->options[] = '';
    }

    public function mount()
    {
        $this->options = ['']; // Initialize with an empty option
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options); // Reindex the array
    }

    public function submitForm()
    {
        // Validate form fields
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'end_time' => 'required|integer|min:1',
            'state' => 'required|in:live,draft,closed',
            'options.*' => 'required|string|max:255', // Ensure each option is a string
        ]);

        // Handle form submission logic here
        // For demonstration purposes, you can simply dump the validated data
        dd($validatedData);
    }

    public function render()
    {
        // Pass the options array to the Blade view
        return view('livewire.poll-form', [
            'options' => $this->options,
        ]);
    }
}
