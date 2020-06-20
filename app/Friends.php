<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $fillable = [
        'user_id', 'friend_id', 'status',
    ];

    public $timestamps = false;
}
