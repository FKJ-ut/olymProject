<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Question;
use App\Models\QuestionLog;
use App\Models\QuestionTranslation;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class QuestionsController extends Controller
{
    // Method to show all sections
    public function index()
    {
        $sections = Section::all()->orderBy('created_at', 'asc') // Order by creation date, ascending (oldest first)
        ->get();
        return view('sections.index', compact('sections'));
    }

    // Method to show all questions of a section
    public function showQuestions($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        $questions = $section->questions()->orderBy('created_at', 'asc')->get();
        return view('sections.questions', compact('section', 'questions'));
    }

    //Method to create question
    public function create($sectionId)
    {
        // Find the section by ID
        $section = Section::findOrFail($sectionId);

        // Pass the section ID to the view
        return view('questions.create', compact('section'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'section_id' => 'required|exists:sections,id', // Ensure section_id exists in the sections table
        ]);

        // Create the new question
        $question = Question::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'], // Use validated description
            'section_id' => $validatedData['section_id'], // Use validated section_id
        ]);

        QuestionLog::create([
            'user_id' => auth()->id(), // Get the current authenticated user's ID
            'question_id' => $question->id, // Set the question_id to the newly created question's ID
            'operation' => 'creation', // Indicate that this is a creation operation
            'original_content' => null, // There's no original content for a new question
            'updated_content' => null, // Store the entire question as updated content
        ]);

        // Redirect back to the section's questions page with a success message
        return redirect()->route('sections.show', ['section' => $validatedData['section_id']])
            ->with('success', 'Question created successfully!');
    }

    public function destroy(Question $question)
    {
        // Delete associated comments
        Comment::where('question_id', $question->id)->delete();

        // Delete associated translations
        QuestionTranslation::where('question_id', $question->id)->delete();

        // Delete the question
        $question->delete();

        QuestionLog::create([
            'user_id' => auth()->id(), // Get the current authenticated user's ID
            'question_id' => $question->id, // Set the question_id to the ID of the question being deleted
            'operation' => 'deletion', // Indicate that this is a deletion operation
            'original_content' => $question->content, // Store the original content of the question
            'updated_content' => null, // There's no updated content for a deletion
        ]);

        // Redirect back to the section's questions page with a success message
        return redirect()->back()->with('success', 'Question deleted successfully!');
    }

    public function editor(Question $question)
    {
        // Pass the question to the view
        return View::make('questions.editor', compact('question'));
    }

    public function updateTitle(Request $request, Question $question)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Update the question's title
        $question->update([
            'title' => $validatedData['title'],
        ]);

        // Redirect back to the editor page with a success message
        return redirect()->back()->with('success', 'Question title updated successfully!');
    }

    public function saveContent(Request $request, $questionId)
    {
        // Retrieve the content from the request
        $content = $request->input('content');

        // Find the question by ID
        $question = Question::findOrFail($questionId);

        // Store the original content before updating
        $originalContent = $question->content;

        // Update the content for the selected question
        $question->update([
            'content' => $content,
        ]);

        // Create a log entry for the content update
        QuestionLog::create([
            'user_id' => auth()->id(), // Get the current authenticated user's ID
            'question_id' => $question->id, // Set the question_id to the ID of the question being updated
            'operation' => 'update', // Indicate that this is an update operation
            'original_content' => $originalContent, // Store the original content of the question
            'updated_content' => $content, // Store the updated content of the question
        ]);

        return redirect()->back()->with('success', 'Content updated successfully');
    }

    //show logs
    public function showLogs(Question $question)
    {
        // Fetch logs related to the specified question
        $logs = QuestionLog::where('question_id', $question->id)->get();

        // Pass logs to the view
        return view('questions.log', ['logs' => $logs, 'question' => $question]);
    }
}
