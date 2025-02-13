<?php

namespace App\Livewire;

use App\Models\Section;
use App\Models\Translation;
use Livewire\Component;

class TranslationSections extends Component
{
    public $translationId;
    public $translation;
    public $sections;

    public function mount($translationId)
    {
        $this->translationId = $translationId;
        $this->translation = Translation::findOrFail($translationId);
        $this->loadSections();
    }

    public function loadSections()
    {
        // Load all sections
        $this->sections = Section::all();
    }

    public function render()
    {
        return view('livewire.translation-sections');
    }
}
