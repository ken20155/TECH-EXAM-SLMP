<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'external_id',
        'album_id',
        'title',
        'url',
        'thumbnail_url',
    ];
}
