<?php

namespace App\Http\Controllers;

use App\Models\Delegation;
use App\Models\Mark;
use App\Models\Question;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ModerationController extends Controller
{
    public function index()
    {
        // Fetch all delegations
        $delegations = Delegation::all();

        // Pass delegations to the view
        return view('moderation.index', compact('delegations'));
    }

    public function showSections($delegationId)
    {
        // Fetch the delegation
        $delegation = Delegation::findOrFail($delegationId);

        // Fetch sections related to the delegation
        $sections = Section::all();

        // Pass delegation and sections to the view
        return view('moderation.sections', compact('delegation', 'sections'));
    }

    public function show($delegationId, $sectionId)
    {
        // Fetch the delegation
        $delegation = Delegation::findOrFail($delegationId);

        // Fetch the section
        $section = Section::findOrFail($sectionId);

        $questions = Question::where('section_id', $sectionId)
            ->orderBy('created_at', 'asc') // Ascending order for oldest first
            ->get();
        // Fetch all students in the delegation
        $students = Student::where('delegation_id', $delegationId)->get();

        return view('moderation.show', compact('delegation', 'section', 'students', 'questions'));
    }

    public function saveMarks(Request $request, $delegationId, $sectionId)
    {
        $validatedData = $request->validate([
            'students' => 'array',
            'students.*' => 'exists:students,id', // Ensure the student IDs are valid
            'marks' => 'array',
            'marks.*' => 'array', // Ensure marks are an array
            'marks.*.*' => 'numeric|nullable', // Marks should be numeric and nullable
        ]);

        // Check if there are no students selected

        // Get the check-marked students
        $students = $validatedData['students']  ?? []; // This holds the selected students

        if (empty($students)) {
            return redirect()->route('moderation.show', [$delegationId, $sectionId])
                ->with('error', 'No students selected.');
        }

        // Loop through selected students and save their marks
        foreach ($students as $studentId) {
            // Retrieve marks for the student for each question
            $studentMarks = $validatedData['marks'][$studentId] ?? [];

            foreach ($studentMarks as $questionId => $marks) {
                if ($marks !== null) {
                    // Save or update the marks in the database
                    Mark::updateOrCreate(
                        [
                            'student_id' => $studentId,
                            'question_id' => $questionId,
                        ],
                        [
                            'marks' => $marks, // Store the entered marks (allow decimal)
                        ]
                    );
                }
            }
        }

        return redirect()->route('moderation.show', [$delegationId, $sectionId])
            ->with('success', 'Marks saved successfully!');
    }

}
