<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Laravel\Scout\Searchable;

class Website extends Model
{
    use SoftDeletes;
    // use Searchable;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    function category()
    {
        return $this->belongsTo('App\Category');
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }
}
