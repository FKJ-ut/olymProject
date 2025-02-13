<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SectionController extends Controller
{

    public function index()
    {
        $sections = Section::all();
        return view('livewire.index', compact('sections'));
    }

    public function dashboard()
    {
        $sections = Section::all();
        return view('dashboard', compact('sections'));
    }

    public function sections($translationId)
    {
        $translation = Translation::findOrFail($translationId);
        $sections = Section::all();
        return view('downloads.sections', compact('sections', 'translation'));
    }

    public function translations()
    {
        $translations = Translation::all();
        return view('downloads.translations', compact('translations'));
    }

    public function show(Section $section)
    {
        // Load the questions related to the section
        $questions = $section->questions()->orderBy('created_at', 'asc')->get();;

        return view('sections.show', compact('section', 'questions'));
    }

    public function create()
    {
        return view('create');
    }

    public function delete($sectionId)
    {
        $section = Section::findOrFail($sectionId);

        // Delete comments associated with questions in the section
        $section->questions()->each(function ($question) {
            $question->comments()->delete();
            $question->translations()->delete();
        });

        // Delete questions belonging to the section
        $section->questions()->delete();

        // Delete the section itself
        $section->delete();

        return redirect()->route('dashboard')->with('success', 'Section deleted successfully!');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create the new section
        Section::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);

        // Redirect back to the section creation page with a success message
        return redirect()->route('dashboard')->with('success', 'Section created successfully!');
    }
}
