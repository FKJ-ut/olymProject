<?php

namespace App\Models;

use App\Models\Mark;
use App\Models\Delegation;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'name',
        'delegation_id',
        'serialNo',
    ];

    public function delegation()
    {
        return $this->belongsTo(Delegation::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function getMarksForQuestion($studentId, $questionId)
    {
        $mark = Mark::where('student_id', $studentId)
                    ->where('question_id', $questionId)
                    ->first();

        return $mark ? $mark->marks : null;
    }

}
