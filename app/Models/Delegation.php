<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delegation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tag',
    ];

    public function translation()
    {
        return $this->hasOne(Translation::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
