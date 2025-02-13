<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Comment;
use App\Models\Section;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Services\ChatGPTService;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

//use App\Models\Comment;

class CommentsController extends Controller
{

    protected $chatGPTService;

    // Inject ChatGPTService into the controller
    public function __construct(ChatGPTService $chatGPTService)
    {
        $this->chatGPTService = $chatGPTService;
    }

    public function categorize($questionId)
    {
            // Fetch all comments related to the specific question
            $comments = Comment::where('question_id', $questionId)->get();

            // Extract the comment texts
            $commentTexts = $comments->pluck('content')->toArray();

            // Check if there are comments to process
            if (empty($commentTexts)) {
                return redirect()->route('comments.show', ['question' => $questionId])
                    ->with('error', 'No comments found for this question.');
            }

            // Categorize comments using ChatGPT
            $summary = $this->chatGPTService->categorizeComments($commentTexts);

            // Parse the summary into categories
            return view('comments.categorize', [
                'questionId' => $questionId,
                'content' => $summary,  // Pass the full summary directly as content
            ]);
    }

    protected function parseSummary($summary)
    {
        // Your logic to parse the summary into categories
        // Example parsing logic:
        $categories = [];
        $lines = explode("\n\n", $summary);

        foreach ($lines as $line) {
            if (preg_match('/^(Category \d+):\n(.*)\nDescription: (.*)$/s', $line, $matches)) {
                $categories[$matches[1]] = [
                    'comments' => array_filter(array_map('trim', explode("\n", $matches[2]))),
                    'description' => trim($matches[3]),
                ];
            }
        }

        return $categories;
    }

    /*
    public function categorize($questionId){

    // Fetch all comments related to the specific question
    $comments = Comment::where('question_id', $questionId)->get();

    // Extract the comment texts
    $commentTexts = $comments->pluck('text')->toArray();

    // Check if there are comments to process
    if (empty($commentTexts)) {
    return redirect()->route('comments.show', ['question' => $questionId])
    ->with('error', 'No comments found for this question.');
    }

    $result = OpenAI::chat()->create([
        'model' => 'gpt-40-mini',
        'messages' => [
            ['role' => 'user', 'content' => 'Hello!'],
        ],
    ]);

    echo $result->choices[0]->message->content; // Hello! How can I assist you today?
    }
    */

    public function index()
    {
        $sections = Section::all();
        return view('comments.sections', ['sections' => $sections]);
    }

    public function showQuestion(Section $section)
    {
        // Retrieve the comments for the specified section
        $questions = $section->questions()->orderBy('created_at', 'asc')->get();

        // You can customize the logic here as per your requirements

        return view('comments.questions', compact('section', 'questions'));
    }

    public function show(Question $question)
    {
        // Fetch comments for the specified question
        $comments = $question->comments;

        // Return the view with question and comments data
        return view('comments.show', compact('question', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($question_id)
    {
        // Pass the question_id to the view
        return view('comments.create', ['question_id' => $question_id]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, Question $question)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        // Create the comment
        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->question_id = $question->id;
        $comment->user_id = Auth::id(); // Get the authenticated user's ID

        // Save the comment
        $comment->save();
        $question_id = $question->id;

        // Redirect back to the question's page with a success message
        return view('comments.show', compact('question', 'question_id'));

    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
