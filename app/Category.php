<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Returns all subcategories of given category
     * @return \App\Subcategory
     */
    function subcategories()
    {
        return $this->hasMany('App\Subcategory')->orderBy('name');
    }

    function websites()
    {
        return $this->hasManyThrough('App\Website', 'App\Subcategory')->where('active', '=', 1);
    }
}
