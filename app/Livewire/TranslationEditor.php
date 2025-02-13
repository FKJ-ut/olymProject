<?php

namespace App\Livewire;

use App\Models\QuestionTranslation;
use Livewire\Component;

class TranslationEditor extends Component
{
    public $questionTranslation;
    public $language;
    public $question;
    public $sectionName;

    public function mount(QuestionTranslation $questionTranslation)
    {
        $this->questionTranslation = $questionTranslation;
        $this->language = $questionTranslation->translation->language;
        $this->question = $questionTranslation->question;
        $this->sectionName = $questionTranslation->question->section->title;
    }

    public function render()
    {
        return view('livewire.translation-editor');
    }
}
