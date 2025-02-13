<?php

namespace App\Http\Controllers;

use App\Models\Section;
use setasign\Fpdi\Fpdi;
use App\Models\Question;
use setasign\Fpdi\PdfReader;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\QuestionTranslation;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    // Method to generate and store the PDF
    public function generatePDF($id)
    {
        // Fetch the question from the database
        $question = Question::findOrFail($id);

        // Prepare the data for the PDF
        $data = ['question' => $question,
    'title' => $question->title];

        // Generate the PDF
        $pdf = PDF::loadView('pdf_template', $data);

        // Define the file path in the public directory
        $pdfPath = 'pdfs/question_' . $id . '.pdf';

        // Save the PDF to the public directory
        $pdf->save(public_path($pdfPath));

        // Store the path in the database
        $question->file_path = $pdfPath;
        $question->save();

        // Redirect to the editor page with a success message
        return redirect()->route('questions.editor', ['question' => $question])->with('success', 'PDF generated successfully!');
    }

    public function translationPDF($id)
    {
        // Fetch the question from the database
        $questionTranslation = QuestionTranslation::findOrFail($id);

        // Prepare the data for the PDF
        $data = ['question' => $questionTranslation,
    'title' => $questionTranslation->question->title];

        // Generate the PDF
        $pdf = PDF::loadView('pdf_template', $data);

        // Define the file path in the public directory
        $pdfPath = 'pdfs/translation_' . $id . '.pdf';

        // Save the PDF to the public directory
        $pdf->save(public_path($pdfPath));

        // Store the path in the database
        $questionTranslation->file_path = $pdfPath;
        $questionTranslation->save();

        // Redirect to the editor page with a success message
        return redirect()->route('question-translation.editor', [
            'questionTranslation' => $questionTranslation])->with('success', 'PDF generated successfully!');
    }

    // Method to display the stored PDF
    public function showPDF($id)
    {
        $question = Question::findOrFail($id);

        // Check if the PDF exists
        if (!Storage::exists($question->pdf_path)) {
            return redirect()->back()->with('error', 'PDF not found.');
        }

        // Return the PDF for download or display in the browser
        return response()->file(storage_path('app/' . $question->pdf_path));
    }

    public function downloadSectionPDF($translationId, $sectionId)
    {
        // Fetch the section
        $section = Section::findOrFail($sectionId);

        //Find Questions belonging to the section
        $questionIds = Question::where('section_id', $sectionId)->pluck('id');

        // Fetch all QuestionTranslations for the given section and translation
        $questionTranslations = QuestionTranslation::whereIn('question_id', $questionIds)
        ->where('translation_id', $translationId)
        ->orderBy('created_at', 'asc')
        ->get();

        // Initialize FPDI to combine PDFs
        $pdf = new FPDI();

        // Loop through each QuestionTranslation and add the PDF to FPDI
        foreach ($questionTranslations as $questionTranslation) {
            // Get the path to the PDF file
            $filePath = storage_path($questionTranslation->file_path);

            if (file_exists($filePath)) {
                // Add each page of the PDF to the FPDI object
                $pageCount = $pdf->setSourceFile($filePath);
                for ($i = 1; $i <= $pageCount; $i++) {
                    $tplIdx = $pdf->importPage($i);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx, 10, 10, 200); // Adjust dimensions as necessary
                }
            }
        }

        // Output the merged PDF as a download
        $filename = $section->title . '_Questions.pdf';

        // Save the merged PDF to a temporary file
        $outputFile = storage_path('app/public/' . $filename);
        $pdf->Output($outputFile, 'F');

        // Return the merged PDF as a download and delete the temporary file after download
        return response()->download($outputFile)->deleteFileAfterSend(true);
    }
}
