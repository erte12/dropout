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
     *
     * @param  array $tags
     * @param  \App\Website $website
     * @param  bool $mode - if true it reloads tags for given website if any exist
     */

    public static function createTagsForWebsite($tags, $website, $mode)
    {
        if($mode == true) {
            $website->tags()->delete();
        }

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
        return;
    }
}
