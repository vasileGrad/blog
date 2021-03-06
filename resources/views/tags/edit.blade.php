@extends('main')

@section('title', "| Edit Tag")

@section('content')

	<!-- Form::model() does the model form binding -->
	<!--  Takes that model that we have, It's gonna pass in here and it's gonna fill it in-->
	<!-- $tag - this is the model that we want to fill into the Form -->

	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			{{ Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => "PUT"]) }}

			{{ Form::label('name', "Title:") }}
			{{ Form::text('name', null, ['class' => 'form-control']) }}

			{{ Form::submit('Save Changes', ['class' => 'btn btn-success margin-top-button']) }}

		{{ Form::close() }}
		</div>
	</div>
	

@endsection