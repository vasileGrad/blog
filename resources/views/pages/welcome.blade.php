@extends('main')

@section('title', '| Homepage')

@section('content')

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="jumbotron">
                  <h1>Write what you think!</h1>
                  <p class="lead">Thank you so much for visitin. This is my test website build with Laravel. Please read my latest post!</p>
                  <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
                </div>
            </div>
        </div> <!-- end of header .row -->

        <div class="row">
            <div class="col-md-6 col-md-offset-1">

                @foreach($posts as $post)

                    <div class="post margin-left-post">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ substr(strip_tags($post->body), 0, 200) }}{{ strlen(strip_tags($post->body)) > 200 ? "..." : "" }}</p>
                        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
                    </div>

                    <hr>

                @endforeach

                
            </div>

            <div class="col-md-3 col-md-offset-1">
                <div class="list-group">
                              <a href="{{ route('categories.index') }}" class="list-group-item active"><h4>
                                Categories
                              </h4></a>

                    <div class="row">
                        <div class="col-md-12">
                            @foreach($categories as $category)
                                  <a href="{{ route('categories.show', $category->id) }}" class="list-group-item">{{ $category->name }}</a>
                                
                            @endforeach
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
@endsection

    