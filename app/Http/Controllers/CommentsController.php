<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Session;
use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        // authenticate everything except the store method
        $this->middleware('auth', ['except' => 'store']);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'comment'    => 'required|min:5|max:2000'
            ));

        // grabs the post object
        $post = Post::find($post_id);

        $auth_name = Auth::user()->name;
        $auth_email = Auth::user()->email;

        $comment = new Comment();
        $comment->name = $auth_name;
        $comment->email = $auth_email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);

        $comment->save();

        Session::flash('success', 'Comment was added!');

        return Redirect()->route('blog.single', [$post->slug]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // grab the comment object
        $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);
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
        $comment = Comment::find($id);

        $this->validate($request, array('comment' => 'required|min:5|max:2000'));

        $comment->comment = $request->comment;
        $comment->save();

        Session::flash('success', 'Comment updated!');

        return redirect()->route('posts.show', $comment->post->id);
    }

    public function delete($id) 
    {
        // grab the comment that we want to delete
        // send it to a view and then conform it
        $comment = Comment::find($id);
        return view('comments.delete')->withComment($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $comment->delete();

        Session::flash('success', 'Comment Deleted!');

        return redirect()->route('posts.show', $post_id);
    }
}
