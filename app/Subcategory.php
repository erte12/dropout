<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Returns parent category
     * @return Category - parent category
     */
    function category()
    {
        return $this->belongsTo('App\Category');
    }

    function websites()
    {
        return $this->hasMany('App\Website')->orderBy('created_at', 'desc');
    }
}
