<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'external_id',
        'user_id',
        'title',
        'completed',
    ];
}
