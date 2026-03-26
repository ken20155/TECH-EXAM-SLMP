<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'external_id',
        'post_id',
        'name',
        'email',
        'body',
    ];
}
