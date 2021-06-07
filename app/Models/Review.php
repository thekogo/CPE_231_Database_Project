<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'rating',
        'status',
        'create_date',
        'enrollment_id',
    ];

    public $timestamps = false;

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
