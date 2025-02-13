<?php

namespace App\Livewire;

use Livewire\Component;

class QuestionSection extends Component
{
    public $title;
    public $description;
    public $content;

    public function mount($title, $description, $content)
    {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
    }

    public function render()
    {
        return view('livewire.question-section');
    }
}
