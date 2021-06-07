<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{

    protected $fillable = ['user_id', 'university', 'degree', 'department'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
