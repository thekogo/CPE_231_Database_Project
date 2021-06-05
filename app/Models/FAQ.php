<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'create_date',
        'lesson_id',
    ];

    public $timestamps = false;

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
