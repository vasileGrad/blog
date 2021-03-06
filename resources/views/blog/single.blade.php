@extends('main')

@section('title', "| $post->title")

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			@if ($post->image)
				<img src="{{ asset('images/' . $post->image) }}" height="300" width="600" />
			@endif
			<h1>{{ $post->title }}</h1>
			<p>{!! $post->body !!}</p>
			<hr>
			<p>Category: {{ $post->category->name }}</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="comments-title"><span class="glyphicon glyphicon-comment"></span>{{ $post->comments()->count() }} Comments</h3>
			@foreach($post->comments as $comment)
				<div class="comment">
					<div class="author-info">
						<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=identicon" }}" class="author-image">
						<div class="author-name">
							<h4>{{ $comment->name }}</h4>
							<p class="author-time">{{ date('F jS, Y - g:i A', strtotime($comment->created_at)) }}</p>
						</div>
						
					</div>

					<div class="comment-content">
						{{ $comment->comment }}
					</div>
					<hr>
				</div>
			@endforeach
		</div>
	</div>

	@if (Auth::check()) 
		<div class="row">
			<div id="comment-form" class="col-md-8 col-md-offset-2 margin-top-button-comment">
				<!-- We submit a comment but we attach a post id for the comment that was linked to -->
				{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}

					<div class="row">
						<div class="col-md-9 col-md-offset-1">
							{{ Form::label('comment', "Comment:") }}
							{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}

							<div class="col-md-6 col-md-offset-3">
								{{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block margin-top-button']) }}
							</div>
						</div>
					</div>

				{{ Form::close() }}
			</div>
		</div>
	@else 
		<div class="row">
			<div id="comment-form" class="col-md-8 col-md-offset-2 margin-top-button-comment">
				<a href="{{ route('login') }}"><button class="btn btn-primary">Comment</button></a>
			</div>
		</div>
	@endif

@endsection