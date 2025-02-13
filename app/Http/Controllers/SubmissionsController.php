<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionsController extends Controller
{
    public function index()
    {
        $submissions = Submission::with('student', 'section')->get();

        return view('submissions.index', compact('submissions'));
    }



    public function upload()
    {
        // Fetch all sections
        $sections = Section::all();

        // Fetch all students
        $students = Student::all();

        // Pass sections and students to the view
        return view('submissions.upload', compact('sections', 'students'));
    }



    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id', // Ensure student_id exists in the students table
            'section_id' => 'required|exists:sections,id', // Ensure section_id exists in the sections table
            'file' => 'required|file|mimes:pdf|max:2048', // Ensure the file is a PDF and within size limits
        ]);

        // Store the file and get the path
        $filePath = $request->file('file')->store('submissions', 'public');

        // Create the new submission
        Submission::create([
            'file' => $filePath, // Store the path of the uploaded file
            'section_id' => $validatedData['section_id'], // Use validated section_id
            'student_id' => $validatedData['student_id'], // Use validated student_id
        ]);

        // Redirect back to the submissions page with a success message
        return redirect()->route('submissions.index')->with('success', 'PDF uploaded successfully.');
    }

    public function download($id)
    {
        // Find the submission by ID
        $submission = Submission::findOrFail($id);

        // Check if the file exists
        if (!Storage::disk('public')->exists($submission->file)) {
            return abort(404, 'File not found.');
        }

        // Find the associated student and section
        $student = Student::findOrFail($submission->student_id);
        $section = Section::findOrFail($submission->section_id);

        // Generate the filename using serialNo and section name
        $filename = sprintf('%s_%s.pdf', $student->serialNo, $section->title);

        // Return the file for download with the custom filename
        return response()->download(storage_path("app/public/{$submission->file}"), $filename);
    }

    public function destroy($id)
{
    // Find the submission by ID
    $submission = Submission::findOrFail($id);

    // Delete the file from storage
    if (Storage::disk('public')->exists($submission->file)) {
        Storage::disk('public')->delete($submission->file);
    }

    // Delete the submission record from the database
    $submission->delete();

    // Redirect back with a success message
    return redirect()->route('submissions.index')->with('success', 'Submission deleted successfully.');
}

}
