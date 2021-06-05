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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function course_categories()
    {
        return $this->hasMany(CourseCategory::class);
    }

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
        if ($value != null)
            return "/storage/" . str_replace("public/", "", $value);
        return "/images/default1.png"; // default image path
    }

    public static function createCourseImg(UploadedFile $file)
    {
        return $file->store(
            '/public/course_img'
        );
    }

    public static function updateCourseCategories($categories, $course)
    {
        CourseCategory::where('course_id', $course->id)->delete();
        if ($categories == null) return;
        foreach ($categories as $category) {
            $category_id = null;
            if (Category::where('name', $category)->exists()) {
                $category_id = Category::where('name', $category)->first()->id;
            } else {
                $category_id = Category::create(['name' => $category, 'status' => "Active"])->id;
            }
            CourseCategory::create([
                'course_id' => $course->id,
                'category_id' => $category_id
            ]);
        }
    }
}
