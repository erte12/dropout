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
    public function subcategories()
    {
        return $this->hasMany('App\Subcategory')->orderBy('name');
    }

    /**
     * Returns all websites that belongs to this category
     * @return \App\Website
     */
    public function websites()
    {
        return $this->hasManyThrough('App\Website', 'App\Subcategory')->where('active', '=', 1);
    }

    /**
     * Generate sluggified viersion of name
     * @return string
     */
    public function getSlugAttribute(): string
    {
        return str_slug($this->name);
    }

    /**
     * Generate friendly url
     * @return string
     */
    public function getFriendlyUrlAttribute(): string
    {
        return action('CategoryController@show', [$this->slug]);
    }
}
