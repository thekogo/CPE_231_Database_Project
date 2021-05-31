<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'course_category',
        'course_description',
        'price',
        'course_status', 
        'create_date', 
        'expire_date', 
        'hours_left', 
        'user_id'
    ];

    private $mapTextToInt = [
        "ปิดการมองเห็น" => 0,
        "เผยแพร่" => 1,
    ];

    private $mapIntToText = [
        "ปิดการมองเห็น",
        "เผยแพร่"
    ];

    public function setCourseStatusAttribute($value)
    {
        $this->attributes['course_status'] = $this->mapTextToInt[$value];
    }

    public function getCategoryStatusAttribute($value)
    {
        return $this->mapIntToText[$value];
    }

    public $timestamps = false;
}
