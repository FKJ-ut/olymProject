<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionLog extends Model
{
    use HasFactory;

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions_logs';

    protected $fillable = [
        'user_id',
        'operation',
        'question_id',
        'original_content',
        'updated_content',
    ];

    // Define a relationship with the User model if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
