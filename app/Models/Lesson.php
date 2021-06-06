<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    protected $appends = [
        'is_learned',
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

    public function getIsLearnedAttribute()
    {
        $course_id = $this->course_id;
        $enrollment = Enrollment::where('course_id', $course_id)->where('user_id', Auth::id())->first();
        if (!$enrollment) return;
        return LessonHistory::where('lesson_id', $this->id)->where('enrollment_id', $enrollment->id)->exists();
    }

    public function getNextLessonId()
    {
        return Lesson::where('course_id', $this->course_id)
            ->where('order', '>', $this->order)
            ->orderBy('order')->first();
    }
}
