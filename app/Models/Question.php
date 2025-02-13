<?php

// app\Models\Question.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'text', 'section_id', 'description', 'content'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function translations()
    {
        return $this->hasMany(QuestionTranslation::class);
    }
}
