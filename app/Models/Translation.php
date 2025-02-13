<?php

namespace App\Models;

use App\Models\Delegation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Translation extends Model
{
    use HasFactory;

    protected $table = 'translations';

    protected $fillable = [
        'language',
        'delegation_id',
    ];

    public function delegation()
    {
        return $this->belongsTo(Delegation::class);
    }
}
