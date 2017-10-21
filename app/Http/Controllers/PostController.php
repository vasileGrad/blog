<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{

    public function __construct() {
        $this->middleware('auth'); // only autenticated users
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create a variable and store all the blog posts from DB

        // it's stores a brande new row to the DB
        //$posts = Post::all();
        $posts = Post::orderBy('id', 'desc')->paginate(5); // 5 is the number of posts per page

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
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create')->withCategories($categories)->withTags($tags);
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

        //dd($request); // dump and die

        // 1. Validate the data
        $this->validate($request, array(
            // rules 
            'title'         => 'required|max:255',
            'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'   => 'required|integer',
            'body'          => 'required',
            'featured_image'=> 'sometimes|image'
        )); // validate the request
        // if the data is not valid what it does? Jumps back to the Create() action and will post the errors


        // 2. store in the database

        // create a new instance of a Model
        $post = new Post;

        // adding thing to this brand new object to be created 
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;

        // we use Purifier to clean and secure
        $post->body = Purifier::clean($request->body);

        // save our Image 
        if($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            // rename the file
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // choose a location public/images/$filename
            $location = public_path('images/' . $filename);
            // create an Image object and pass in any settings that we need
            // take the image, resize it to where we want and then saves it at this location
            Image::make($image)->resize(800, 400)->save($location);

            // put the file in the Database
            // save the name of the file inside the post column
            $post->image = $filename;

        }

        $post->save(); // save the object
        // save the new item into the Database

        // this post it's gonna give us an id number
        $post->tags()->sync($request->tags, false);

        // $request->tags - is the id of the post
        // false - telling to overide the existing association. If you forget to write false it will delete all and set these as a new association. We want to add them !!!!!!
        // sync - creates that relationship and sync it up

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
        $post = Post::find($id);  // also deep linking for the categories
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
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = array();
        // we create an associative array
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        // return the view and pass in the var we previously created
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
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
        $post = Post::find($id);

        $this->validate($request, array(
            // rules 
            'title' => 'required|max:255',
            'slug' => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id' => 'required|integer',
            'body' => 'required',
            'featured_image' => 'image'
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
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));

        // if it is added the photo we need to update
        if ($request->hasFile('featured_image')) {
            
            // Add the new photo
            $image = $request->file('featured_image');
            // rename the file
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // choose a location public/images/$filename
            $location = public_path('images/' . $filename);
            // create an Image object and pass in any settings that we need
            // take the image, resize it to where we want and then saves it at this location
            Image::make($image)->resize(800, 400)->save($location);

            $oldFilename = $post->image;

            // Update the Database to reflect the new photo

            // put the file in the Database
            // save the name of the file inside the post column
            $post->image = $filename;

            // Delete the old photo
            Storage::delete($oldFilename);
            // modification in the config/filesystems.php to modify the path 'root' => public_path('images/'),
            // by Default it's gonna go to the public file, it's gonna find something with the old filename and it's gonna delete it 
        }

        $post->save();

        // if it's empty we are going to sync it out with 0 items
        if (isset($request->tags)) {
            // $request->tags - is an array
            $post->tags()->sync($request->tags); // the same effect
        } else {
            $post->tags()->sync(array());
        }

        // $post->tags()->sync($request->tags, true);
        // it will take all the relationships for this post, it removes them and adds whatever it's in this array. It deletes the old once

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
        // removes any reference of posts to the post_tags Model
        $post->tags()->detach();
        Storage::delete($post->image);

        $post->delete();

        Session::flash('success', 'The post was successfully deleted!');

        return redirect()->route('posts.index');
    }
}
