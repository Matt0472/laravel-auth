<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable =
    [
        'name',
        'path'
    ];

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
