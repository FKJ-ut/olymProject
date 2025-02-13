<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\ApiTestController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CommentsController;

use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\ModerationController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\SubmissionsController;
use App\Http\Controllers\TranslationController;

Route::get('/login', function () {
    return view('livewire.login');
});

Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
Route::get('/sections/{section}', [SectionController::class, 'show'])->name('sections.show');

// Define a route for creating a new question for a specific section
Route::get('/questions/create/{section}', [QuestionsController::class, 'create'])->name('questions.create');

//Questions

// Group routes requiring authentication and verification
Route::middleware(['auth', 'verified'])->group(function () {
    // Questions routes
    Route::get('/questions/create/{section}', [QuestionsController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionsController::class, 'store'])->name('questions.store');
    Route::delete('/questions/{question}', [QuestionsController::class, 'destroy'])->name('questions.destroy');
    Route::get('/questions/{question}/editor', [QuestionsController::class, 'editor'])->name('questions.editor');
    Route::put('/questions/{question}/update-title', [QuestionsController::class, 'updateTitle'])->name('questions.updateTitle');
    Route::post('/questions/{questionId}/save-content', [QuestionsController::class, 'saveContent'])->name('questions.save-content');
    Route::get('/questions/{question}/logs', [QuestionsController::class, 'showLogs'])->name('questions.logs');
});

Route::get('/', function () {
    return view('welcome');
});

// Define the dashboard route
Route::get('dashboard', [SectionController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//Sections Route
Route::get('/create', [SectionController::class, 'create'])->name('create');
Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
Route::delete('/sections/{section}', [SectionController::class, 'delete'])->name('sections.delete');

//Downloads Route
Route::get('/downloads/translations', [SectionController::class, 'translations'])->name('downloads.translations');
Route::get('/downloads/translations/{translationId}/sections', [SectionController::class, 'sections'])->name('downloads.sections');
Route::get('/downloads/translations/{translationId}/sections/{sectionId}', [PDFController::class, 'downloadSectionPDF'])->name('downloads.downloadPdf');


//Comments Route
Route::get('comments', [CommentsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('comments');

Route::get('/comments/{section}', [CommentsController::class, 'showQuestion'])->name('comments.questions');
Route::get('/comment/{question}', [CommentsController::class, 'show'])->name('comment.show');
Route::get('/comments/create/{question_id}', [CommentsController::class, 'create'])->name('comments.create');
Route::post('/comments/{question}', [CommentsController::class, 'store'])->name('comments.store');

//Voting Route
Route::get('/voting', [VotingController::class, 'index'])->name('voting.index');
Route::get('/voting/{poll}', [VotingController::class, 'show'])->name('voting.show');
Route::post('/voting', [VotingController::class, 'store'])->name('voting.store');
Route::delete('/voting/{poll}', [VotingController::class, 'delete'])->name('voting.destroy');
Route::get('/voting/{poll}/manage', [VotingController::class, 'manage'])->name('voting.edit');
Route::get('createPoll', [VotingController::class, 'create'])->name('createPoll');
Route::post('/unvote/{option}', [VotingController::class, 'unvote'])->name('unvote');


//Users Routes
Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware(['auth', 'hostGuard']);
Route::get('/users/create', [UserController::class, 'createabc'])->name('users.create')->middleware(['auth', 'hostGuard']);
Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware(['auth', 'hostGuard']);
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(['auth', 'hostGuard']);

//Translation Routes
Route::get('/translation', [TranslationController::class, 'index'])->name('translation.index');
Route::get('/translation/create', [TranslationController::class, 'create'])->name('translation.create');
Route::post('/translation', [TranslationController::class, 'store'])->name('translation.store');
Route::get('/translations/{translationId}/section', [TranslationController::class, 'section'])->name('translation.sections');
Route::get('/translations/{translationId}/sections/{sectionId}/questions', [TranslationController::class, 'showQuestions'])
    ->name('translations.questions');
Route::get('/question-translation/{questionTranslation}/editor', [TranslationController::class, 'editor'])->name('question-translation.editor');
Route::get('/translations/{translationId}/{sectionId}', [TranslationController::class, 'createTranslation'])->name('translations.createTranslation');
Route::get('/translation/ai/{questionTranslationId}', [TranslationController::class, 'aiTranslation'])
    ->name('AItranslation');
    Route::put('/translation/{questionTranslationId}', [TranslationController::class, 'updateTranslation'])->name('translations.update');
    Route::post('/vote/{option}', [VotingController::class, 'vote'])->name('vote');


// Define the profile route
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//submissions
Route::get('/submissions', [SubmissionsController::class, 'index'])->name('submissions.index');
Route::get('/submissions/upload', [SubmissionsController::class, 'upload'])->name('submissions.upload');
Route::post('/submissions/store', [SubmissionsController::class, 'store'])->name('submissions.store');

// Routes for downloading and deleting submissions
Route::get('submissions/{id}/download', [SubmissionsController::class, 'download'])->name('submissions.download');
Route::delete('submissions/{id}', [SubmissionsController::class, 'destroy'])->name('submissions.destroy');


//moderation
Route::get('moderation', [ModerationController::class, 'index'])->name('moderation.index');
Route::get('moderation/{delegation}/sections', [ModerationController::class, 'showSections'])->name('moderation.sections');
Route::get('moderation/{delegation_id}/{section_id}', [ModerationController::class, 'show'])->name('moderation.show');
Route::post('moderation/{delegation_id}/{section_id}/save', [ModerationController::class, 'saveMarks'])->name('moderation.saveMarks');

Route::get('/submissionsf', [SubmissionsController::class, 'index'])->name('moderations.index');

//Students
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/students', [StudentController::class, 'store'])->name('student.store');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

//AI FEATURES
Route::get('/comments/categorize/{question_id}', [CommentsController::class, 'categorize'])->name('comments.categorize');

//TESTING
Route::get('/api-test', [ApiTestController::class, 'testApi']);
Route::get('/test-openai', [ApiTestController::class, 'getChatGPTResponse']);

//PDF GENERATION
Route::get('/questions/generate-pdf/{id}', [PDFController::class, 'generatePDF'])->name('questions.generate-pdf');
Route::get('/translationPDF/{id}', [PDFController::class, 'translationPDF'])->name('translationPDF');
Route::get('/pdfs/{filename}', function ($filename) {
    $filePath = public_path('pdfs/' . urldecode($filename));

    if (file_exists($filePath)) {
        return response()->file($filePath);
    } else {
        abort(404, 'File not found.');
    }
})->where('filename', '.*');



//Image Upload
Route::post('/upload-image', [ImageUploadController::class, 'store'])->name('upload-image');
Route::post('/ckeditor/upload', [App\Http\Controllers\CKEditorController::class, 'upload'])->name('ckeditor.upload');

//Delegations
Route::get('/delegations/view', [UserController::class, 'delegationIndex'])->name('delegations.index');
Route::get('/delegations/create', [UserController::class, 'createDelegation'])->name('delegations.create');
Route::post('/delegations', [UserController::class, 'storeDelegation'])->name('delegations.store');
Route::delete('/delegations/{delegation}', [UserController::class, 'destroyDelegation'])->name('delegations.destroy');

//Security
Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized');


require __DIR__ . '/auth.php';
