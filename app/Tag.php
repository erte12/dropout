<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = [
        'name',
    ];

    function tags()
    {
        return $this->belongsToMany('App\Website');
    }
}
