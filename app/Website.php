<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'url',
        'description',
        'subcategory_id',
        'edit',
        'active'
    ];

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    /**
    * Get the user that owns the website.
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Return website's tags in string with commas
     * @return string
     */
    public function getTagsString()
    {
        $tags = $this->tags;
        $result = '';
        for($i = 0; $i < $tags->count(); $i++)  {
            $result = $result . $tags->get($i)->name . (($i < $tags->count() - 1) ? ', ' : '');
        }
        return $result;
    }

    /**
    * Get the website in edit queue.
    */
    public function website_edited()
    {
        return $this->hasOne('App\WebsiteEdited');
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
        return action('WebsiteController@show', [$this->slug, $this->id]);
    }
}
