<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'question_id'];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
