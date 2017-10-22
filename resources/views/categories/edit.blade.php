@extends('main')

@section('title', "| Edit Category")

@section('content')

	<!-- Form::model() does the model form binding -->
	<!--  Takes that model that we have, It's gonna pass in here and it's gonna fill it in-->
	<!-- $category - this is the model that we want to fill into the Form -->
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>Edit Category</h1><br>
			{{ Form::model($category, ['route' => ['categories.update', $category->id], 'method' => "PUT"]) }}

			{{ Form::label('name', "Title:") }}
			{{ Form::text('name', null, ['class' => 'form-control']) }}

			{{ Form::submit('Save Changes', ['class' => 'btn btn-success margin-top-button']) }}

			{{ Form::close() }}
		</div>
	</div>
	

@endsection