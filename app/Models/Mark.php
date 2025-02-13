<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'question_id', 'marks'];

    // Define the relationship with the Poll model
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function votes()
    {
        return $this->belongsTo(Question::class);
    }

    public function getMarksForQuestion($studentId, $questionId)
    {
        $mark = Mark::where('student_id', $studentId)
                    ->where('question_id', $questionId)
                    ->first();

        return $mark ? $mark->marks : null;
    }

}
