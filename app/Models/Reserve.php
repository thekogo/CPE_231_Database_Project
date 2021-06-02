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
}
