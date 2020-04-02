<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'slug',
        'updated_at',
        'path_image'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function images()
    {
        return $this->belongsToMany('App\Image');
    }
}
