<?php

namespace App\Http\Livewire;

use App\Models\Section;
use Livewire\Component;

class Sections extends Component
{
    public $sections;

    public function mount()
    {
        // Retrieve sections data from the database
        $this->sections = Section::all();
    }

    public function render()
    {
        // Pass the $sections variable to the view
        return view('livewire.sections', [
            'sections' => $this->sections
        ]);
    }
}
