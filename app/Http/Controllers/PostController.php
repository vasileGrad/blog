<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create a variable and store all the blog posts from DB

        // it's stores a brande new row to the DB
        $posts = Post::all();

        // return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Request $request  - it's pulling in all the data from the request that may have been submitted with the form 
        // We take this data, we process it and then we are going to submit it to the database 


        // 1. Validate the data
        $this->validate($request, array(
            // rules 
            'title' => 'required|max:255',
            'body' => 'required'
        )); // validate the request
        // if the data is not valid what it does? Jumps back to the Create() action and will post the errors


        // 2. store in the database

        // create a new instance of a Model
        $post = new Post;

        // adding thing to this brand new object to be created 
        $post->title = $request->title;
        $post->body = $request->body;

        $post->save(); // save the object
        // save the new item into the Database

        // If we successfully saved this into the database I wonna be able to pass this to the user
        //Session::flash('key', 'value'); // Creates a flass variable that OR a session that exists for a single request
        // the 'key' - when we try to  reference it
        // the 'value' - this will be the message you want to output 
        Session::flash('success', 'The blog post was successfully saved!');

        // 3. redirect to another page : show() or index()
        return redirect()->route('posts.show', $post->id); // redirect to the named post called posts.show
        // grab the id from the $post->id of the post object
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find an item by the id that it's past in the url
        $post = Post::find($id);
        // render the view and it's gonna pass in a variable called post which is equal to $post
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post in the database and save as a variable

        // $post = our model, and our model is Post
        // we create a Model object called $post and finds a Model from the Database and stores it in this variable and then pass it into the View
        $post = Post::find($id);  // Find that post by the id number

        // return the view and pass in the var we previously created
        return view('posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the data
        $this->validate($request, array(
            // rules 
            'title' => 'required|max:255',
            'body' => 'required'
        ));
        // If it's not validate it's automatecally reload the Edit page and then it's gonna pass in any error that we have

        // Save the data to the database

        // it's updating an existing row
        // grab the post object from the DB
        $post = Post::find($id);
        // we are going to find the existing post and save the changes on top of the existing post

        // set the appropriate thinks and match it with the fields that we have in the Edit Form
        // ->input = identify something from the post input that was passed in to the post
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $post->save();

        // Set flash data with success message
        Session::flash('success', 'This post was successfully saved!');

        // redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the post item
        $post = Post::find($id);

        $post->delete();

        Session::flash('success', 'The post was successfully deleted!');

        return redirect()->route('posts.index');
    }
}
