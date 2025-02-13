<?php

// PollForm.php

// PollForm.php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Poll;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PollForm extends Component
{
    public $title;
    public $description;
    public $end_time;
    public $state;
    public $numOptions = 1;
    public $options = ['']; // Initial empty option

    public function addOption()
    {
        $this->numOptions++;
    }

    public function removeOption()
    {
        $this->numOptions--;
    }

    public function mount()
    {
        $this->options = ['']; // Initialize with an empty option
    }

    public function submitForm()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'end_time' => 'required|integer|min:1',
            'state' => 'required|in:live,draft,closed',
            'options.*' => 'required|string|max:255',
        ]);

        $poll = Poll::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'user_id' => Auth::id(),
            'end_time' => now()->addMinutes($validatedData['end_time']),
            'state' => $validatedData['state'],
        ]);

        foreach ($validatedData['options'] as $optionName) {
            Option::create([
                'name' => $optionName,
                'poll_id' => $poll->id,
            ]);
        }

        session()->flash('success', 'Poll(' . $validatedData['title'] . ') created successfully.');
        return redirect()->route('voting.index');
    }

    public function render()
    {
        // Pass the options array to the Blade view
        return view('livewire.poll-form');
    }
}
