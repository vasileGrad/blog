<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Comments belong to one post and
    // Posts have many comments
    public function post()
    {
    	return $this->belongsTo('App\Post');
    }
}
