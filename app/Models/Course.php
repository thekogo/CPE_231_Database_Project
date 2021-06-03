<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_img',
        'category',
        'description',
        'price',
        'status',
        'create_date',
        'expire_date',
        'hours_left',
        'user_id'
    ];

    public $timestamps = false;

    private $mapTextToInt = [
        "ปิดการมองเห็น" => 0,
        "เผยแพร่" => 1,
        "รอการอนุมัติ" => 2,
    ];

    private $mapIntToText = [
        "ปิดการมองเห็น",
        "เผยแพร่",
        "รอการอนุมัติ"
    ];

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $this->mapTextToInt[$value];
    }

    public function getStatusAttribute($value)
    {
        return $this->mapIntToText[$value];
    }

    public function getCourseImgAttribute($value)
    {
        return "/storage/" . str_replace("public/", "", $value);
    }

    public static function createCourseImg(UploadedFile $file)
    {
        return $file->store(
            '/public/course_img'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
