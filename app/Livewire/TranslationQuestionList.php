<?php

namespace App\Livewire;

use App\Models\QuestionTranslation;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class TranslationQuestionList extends Component
{
    public $translation;
    public $section;
    public $questions;
    public $questionTranslations;

    public function mount($translation, $section)
    {
        $this->translation = $translation;
        $this->section = $section;
        $this->loadQuestions();
        $this->loadQuestionTranslations();
    }

    public function loadQuestions()
    {
        // Retrieve questions for the given section
        $this->questions = $this->section->questions()->get();
    }

    public function loadQuestionTranslations()
    {
        // Retrieve question translations for the specific section and translation
        $this->questionTranslations = QuestionTranslation::whereHas('question', function ($query) {
            $query->where('section_id', $this->section->id);
        })->where('translation_id', $this->translation->id)->get();
    }

    public function render()
    {
        return view('livewire.translation-question-list');
    }

    public function createTranslation($questionId)
    {
        // Logic to create a new translation for the given question
        $translation = new QuestionTranslation();
        $translation->question_id = $questionId;
        $translation->translation_id = $this->translation->id;
        // You may need to adjust this depending on your actual implementation
        $translation->content = ''; // Set default content or leave empty
        $translation->save();

        // Optional: You can emit an event or update any necessary data
        return Redirect::route('translations.questions', [
            'translationId' => $this->translation->id,
            'sectionId' => $this->section->id,
        ])->with('success', 'Translation created successfully!');
    }

    public function deleteTranslation($questionId)
    {
        // Find the question translation to delete
        $translation = QuestionTranslation::where('question_id', $questionId)
            ->where('translation_id', $this->translation->id)
            ->first();

        if ($translation) {
            // Delete the question translation
            $translation->delete();

            // Optional: You can emit an event or update any necessary data
            return Redirect::route('translations.questions', [
                'translationId' => $this->translation->id,
                'sectionId' => $this->section->id,
            ])->with('success', 'Translation deleted successfully!');
        }
    }

    public function updateTranslation($questionId)
    {
        // Find the question translation for the given question ID and current translation ID
        $questionTranslation = QuestionTranslation::where('question_id', $questionId)
            ->where('translation_id', $this->translation->id)
            ->first();

        if ($questionTranslation) {
            // Generate the URL for the editor route
            $url = route('question-translation.editor', ['questionTranslation' => $questionTranslation->id]);

            // Redirect the user to the editor route
            return redirect()->to($url);
        }

        // If the question translation does not exist, handle the error accordingly
        // ...
    }
}
