<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'create_date',
        'description',
        'user_id',
        'question_id',
    ];

    public $timestamps = false;
}
