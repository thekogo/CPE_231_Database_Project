<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order',
        'vdo',
        'description',
        'course_id'
    ];

    public $timestamps = false;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function faqs()
    {
        return $this->hasMany(FAQ::class);
    }

    public static function reOrder($course_id, $order, $insert = 'insert')
    {
        $lessons = Lesson::where('course_id', $course_id)
            ->where('order', '>=', $order)
            ->orderBy('order')->get();
        $initOrder = $order;
        if ($insert == 'insert') {
            $initOrder++;
        }
        foreach ($lessons as $lesson) {
            $lesson->order = $initOrder;
            $lesson->save();
            $initOrder++;
        }
    }
}
