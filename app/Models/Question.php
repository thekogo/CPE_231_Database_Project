<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'create_date',
        'description',
        'lesson_id',
        'enrollment_id',
    ];

    public $timestamps = false;

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
