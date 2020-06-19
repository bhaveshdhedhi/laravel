<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobbies extends Model
{
    public static function list()
    {
        return static::all()->pluck('id', 'name');
    }

    public function Users()
    {
        return $this->belongsToMany('App\Users');
    }
}
