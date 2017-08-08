<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteEdited extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'websites_edited';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'website_id',
        'name',
        'url',
        'description',
        'subcategory_id',
    ];

    /**
    * Get the parent website.
    */
    function website()
    {
        return $this->hasOne('App\Website');
    }

    /**
    * Get the user that owns the website.
    */
    function user()
    {
        return $this->belongsTo('App\User');
    }
}
