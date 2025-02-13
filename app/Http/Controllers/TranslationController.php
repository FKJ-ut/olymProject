<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionTranslation;
use App\Models\Section;
use App\Models\Translation;
use App\Services\ChatGPTService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TranslationController extends Controller
{

    protected $chatGPTService;

    public function __construct()
    {
        // Initialize ChatGPTService with the API key from configuration
        $this->chatGPTService = new ChatGPTService(config('services.openai.api_key'));
    }

    public function aiTranslation(Request $request, $questionTranslationId)
    {
        $questionTranslation = QuestionTranslation::findOrFail($questionTranslationId);

        // Fetch the question and translation
        $question = $questionTranslation->question;
        $translation = $questionTranslation->translation;

        $originalContent = $question->content; // Assume 'content' is the field with the question text
        $originalTranslation = $questionTranslation->content;

        // Fetch the target language from the translation model
        $language = $translation->language; // Ensure this attribute is available and correct

        // Use the ChatGPTService to translate the content
        $newTranslation = $this->chatGPTService->translate($originalContent, $language);
        //$newTranslation = "Test new Translation";

        // Save the new translation temporarily
        // $questionTranslation->content = $translatedContent;
        // $questionTranslation->save();

        // Fetch comparisons and suggestions
        $comparisons = $this->chatGPTService->compareTranslations($originalContent, $originalTranslation, $newTranslation);
        // $comparisons = "Test Comparison";

        // Pass the data to the new view
        return view('translations.comparison', [
            'originalContent' => $originalContent,
            'originalTranslation' => $originalTranslation,
            'newTranslation' => $newTranslation,
            'comparisons' => $comparisons,
            'questionTranslation' => $questionTranslation,
        ]);
    }
/*
    public function aiTranslation(Request $request, $questionTranslationId)
    {
        $questionTranslation = QuestionTranslation::findOrFail($questionTranslationId);

        // Fetch the question and translation
        $question = $questionTranslation->question;
        $translation = $questionTranslation->translation;

        $originalContent = $question->content; // Assume 'content' is the field with the question text

        // Fetch the target language from the translation model
        $language = $translation->language; // Ensure this attribute is available and correct

        // Use the ChatGPTService to translate the content
        $translatedContent = $this->chatGPTService->translate($originalContent, $language);

        // Update the existing translation record
        $questionTranslation->content = $translatedContent; // Update the content with the translated text
        $questionTranslation->save();

        // Redirect with success message
        return redirect()->route('question-translation.editor', [
            'questionTranslation' => $questionTranslation,
        ])->with('success', 'Translation updated successfully!');
    }
        */

    /**
     * Display a listing of the translations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translations = Translation::all();

        return view('translations.index', compact('translations'));
        //return $translations->delegation;
    }

    /**
     * Show the form for creating a new translation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('translations.create');
    }

    public function section($translationId)
    {
        $translation = Translation::findOrFail($translationId)->language;

        return view('translations.section', ['translationId' => $translationId, 'translation' => $translation]);
    }

    public function showQuestions($translationId, $sectionId)
    {
        $translation = Translation::findOrFail($translationId);
        $section = Section::findOrFail($sectionId);

        return view('translations.questions', compact('translation', 'section'));
    }

    /**
     * Display the specified translation.
     *
     * @param  \App\Models\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function show(Translation $translation)
    {
        return view('translations.show', compact('translation'));
    }

    public function edit(Translation $translation)
    {
        return view('translations.edit', compact('translation'));
    }

    public function update(Request $request, Translation $translation)
    {
        $validatedData = $request->validate([
            'value' => 'required|string',
        ]);

        $translation->update($validatedData);

        return redirect()->route('translations.index')->with('success', 'Translation updated successfully.');
    }

    public function destroy(Translation $translation)
    {
        $translation->delete();

        return redirect()->route('translations.index')->with('success', 'Translation deleted successfully.');
    }

    public function editor(QuestionTranslation $questionTranslation)
    {
        return view('translations.editor', compact('questionTranslation'));
    }

    /*
    public function createNewTL($id)
    {
    // Assuming you have logic to get the question and section
    $question = Question::findOrFail($Id);

    $question = $id;

    // Create a new translation
    $translation = new QuestionTranslation();
    $translation->question_id = $question->id;
    $translation->translation_id = $this->translation->id; // Adjust this based on your actual implementation
    $translation->content = ''; // Set default content or leave empty
    $translation->save();

    // Redirect to another route (example: translations.questions) with parameters
    return Redirect::route('translations.questions', [
    'translationId' => $this->$translation->id, // Adjust this as needed
    'sectionId' => $this->$section->id // Adjust this as needed
    ])->with('success', 'Translation created successfully!');
    }
     */

    public function updateTranslation(Request $request, $QuestionTranslationId)
    {
        //Find Question Translation
        $questionTranslation = QuestionTranslation::findOrFail($QuestionTranslationId);

        // Retrieve the content from the request
        $content = $request->input('content');

        // Store the original content before updating
        $originalContent = $questionTranslation->content;

        // Update the content for the selected question
        $questionTranslation->update([
            'content' => $content,
        ]);

        // Create a log entry for the content update
        /*
        QuestionTranslationLog::create([
        'user_id' => auth()->id(), // Get the current authenticated user's ID
        'question_id' => $QuestionTranslation->id, // Set the question_id to the ID of the question being updated
        'operation' => 'update', // Indicate that this is an update operation
        'original_content' => $originalContent, // Store the original content of the question
        'updated_content' => $content, // Store the updated content of the question
        ]);
         */

        return redirect()->route('question-translation.editor', [
            'questionTranslation' => $questionTranslation,
        ])->with('success', 'Content updated successfully');
    }
}
