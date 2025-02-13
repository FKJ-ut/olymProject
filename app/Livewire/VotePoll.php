<?php

// app/Http/Livewire/VotePoll.php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Poll;
use Livewire\Component;

class VotePoll extends Component
{
    public $poll;
    public $options;

    public function mount(Poll $poll)
    {
        //dd($poll);
        $this->poll = $poll;
        // Load the options with the poll and sort them by their IDs
        $this->options = $poll->options()->orderBy('id')->get();
        //dd($this->options);
    }

    public function vote(Option $option)
    {
        // Add the user's vote to the selected option
        $option->votes()->attach(auth()->id());

        // Reload the poll data
        $this->poll->load('options');
        $this->options = $this->poll->options;
    }

    public function unvote(Option $option)
    {
        // Remove the user's vote from the selected option
        $option->votes()->detach(auth()->id());

        // Reload the poll data
        $this->poll->load('options');
        $this->options = $this->poll->options;
    }

    public function render()
    {
        return view('livewire.vote-poll');
    }
}
