<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
