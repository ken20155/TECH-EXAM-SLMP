<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'catch_phrase',
        'bs',
    ];
}
