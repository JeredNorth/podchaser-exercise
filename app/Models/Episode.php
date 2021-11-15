<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'audio_URL',
        'episode_URL',
    ];

    protected $table = 'episodes';    
}
