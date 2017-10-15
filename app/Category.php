<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    // One Category has many posts
    public function posts()
    {
    	return $this->hasMany('\App\Post');
    }
}
