<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = [
        'name',
    ];

    /**
    * Get all tags connected with this website.
    */
    public function tags()
    {
        return $this->belongsToMany('App\Website');
    }

    /**
     * Create tags for given website
     * @param  array $tags
     * @param  Website $website
     */
    public static function createTagsForWebsite($tags, $website)
    {
    	foreach ($tags as $tag_name) {
            $tag = Tag::where(['name' => $tag_name])->first();

            if(is_null($tag)) {
                $website->tags()->create([
                    'name' => $tag_name,
                ]);
            } else {
                $website->tags()->attach($tag->id);
            }
        }
    }
}
