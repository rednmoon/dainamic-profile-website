<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'title', 
        'sub_title', 
        'start_date', 
        'duration', 
        'price', 
        'image', 
        'description', 
        'highlights'
    ];

    protected $casts = [
        'highlights' => 'array', // Automatic JSON to Array Cast
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}