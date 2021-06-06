<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonHistory extends Model
{

    protected $fillable = [
        'lesson_id',
        'enrollment_id',
        'finish_date',
    ];

    public $timestamps = false;

    use HasFactory;
}
