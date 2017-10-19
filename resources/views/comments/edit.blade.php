@extends('main')

@section('title', '| Edit Comment')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h1>Edit Comment</h1>

			<!-- $comment is the object that we are passing in -->
			{{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) }}
				{{ Form::label('name', 'Name:') }}	
				{{ Form::text('name', null, ['class' => 'form-control', 'disabled' => '']) }}

				{{ Form::label('email', 'Email:') }}
				{{ Form::text('email', null, ['class' => 'form-control', 'disabled' => '']) }}

				{{ Form::label('comment', 'Comment:') }}
				{{ Form::textarea('comment', null, ['class' => 'form-control']) }}

				{{ Form::submit('Update Comment', ['class' => 'btn btn-block btn-success margin-top-button-comment']) }}

			{{ Form::close() }}

		</div>
	</div>
	
@endsection