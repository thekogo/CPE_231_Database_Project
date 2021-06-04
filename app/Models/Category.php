<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    private $mapTextToInt = [
        "Draft" => 0,
        "Active" => 1,
    ];

    private $mapIntToText = [
        "Draft",
        "Active"
    ];

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $this->mapTextToInt[$value];
    }

    public function getStatusAttribute($value)
    {
        return $this->mapIntToText[$value];
    }


    // Define Relation
    public function course_categories()
    {
        return $this->hasMany(CourseCategory::class);
    }


    public $timestamps = false;
}
