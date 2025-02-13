<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'title',
        'description',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // In Section.php
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

}
