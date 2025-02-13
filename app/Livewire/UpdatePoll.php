<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class UpdatePoll extends Component
{
    public $poll;

    public $title;
    public $description;
    public $end_time;
    public $state;
    public $options;

    public function mount(Poll $poll)
    {
        //dd($poll);
        $this->poll = $poll;
        $this->title = $poll->title;
        $this->description = $poll->description;
        $this->end_time = $poll->end_time;
        $this->state = $poll->state;
        $this->options = $poll->options()->orderBy('id')->pluck('name')->toArray();
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options); // Reindex the array
    }

    public function submitForm()
    {
        // Validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'end_time' => 'required|integer|min:1',
            'state' => 'required|in:live,draft,closed',
        ];

        // Conditionally apply validation rule for options if options are present
        if (!empty($this->options)) {
            $rules['options.*'] = 'required|string|max:255';
        }

        $this->validate($rules);

        // Update poll data
        $this->poll->update([
            'title' => $this->title,
            'description' => $this->description,
            'end_time' => now()->addMinutes(['end_time']),
        ]);

        // Update options
        $this->poll->options()->delete(); // Remove existing options
        foreach ($this->options as $option) {
            $this->poll->options()->create(['name' => $option]);
        }

        // Redirect or show message
        session()->flash('success', 'Poll created successfully.');
        return redirect()->route('voting.index');

    }

    public function render()
    {
        return view('livewire.update-poll');
    }
}
