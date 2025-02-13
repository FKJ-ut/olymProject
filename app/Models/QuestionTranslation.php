<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    use HasFactory;

    protected $table = 'question_translations';

    protected $fillable = ['question_id', 'translation_id', 'content'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function translation()
    {
        return $this->belongsTo(Translation::class);
    }
}
