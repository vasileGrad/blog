<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;

class BlogController extends Controller
{
	// action = a method inside a Controller
	public function getIndex() {
		$posts = Post::paginate(2);
		return view('blog.index')->withPosts($posts);
	}

    public function getSingle($slug) {
    	// Fetch from the DB based on slug
    	$post = Post::where('slug', '=', $slug)->first();

    	// return the view and pass in the post oject 
    	return view('blog.single')->withPost($post);
    }
}
