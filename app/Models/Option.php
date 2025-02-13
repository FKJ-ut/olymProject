<?php

namespace App\Models;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['poll_id', 'voter_id', 'name'];

    // Define the relationship with the Poll model
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function getVotesAttribute()
    {
        return collect(explode(',', $this->voter_id))->filter()->count();
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function hasVoted($userId)
    {
        return in_array($userId, explode(',', $this->voter_id));
    }
}
