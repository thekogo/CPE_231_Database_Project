<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'hours_reserved',
        'position',
        'status',
        'enrollment_id'
    ];

    public $timestamps = false;

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    private $mapTextToInt = [
        "รอการอนุมัติ" => 0,
        "อนุมัติ" => 1,
    ];

    private $mapIntToText = [
        "รอการอนุมัติ",
        "อนุมัติ",
    ];

    public function getStatusAttribute($value)
    {
        return $this->mapIntToText[$value];
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $this->mapTextToInt[$value];
    }
}
