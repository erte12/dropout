<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * Get all websites that belongs to user.
    * @return \App\Website
    */
    public function websites()
    {
        return $this->hasMany('App\Website');
    }

    /**
    * Get the websites form edit queue.
    * @return \App\WebsiteEdited
    */
    public function websites_edited()
    {
        return $this->hasMany('App\WebsiteEdited');
    }
}
