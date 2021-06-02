<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_name',
        'lesson_order',
        'lesson_vdo',
        'lesson_desciption',
        'course_id'
    ];

    public $timestamps = false;
}
