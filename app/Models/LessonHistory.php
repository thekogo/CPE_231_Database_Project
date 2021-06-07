<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonHistory extends Model
{

    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'enrollment_id',
        'finish_date',
    ];

    public $timestamps = false;

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
