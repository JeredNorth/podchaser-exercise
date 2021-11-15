<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'artwork_URL',
        'feed_URL',
        'description',
        'language',
        'website_URL',
    ];


    protected $table = 'podcasts';
}
