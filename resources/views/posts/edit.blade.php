@extends('main')

@section('title', '| Edit Blog Post')

@section('content')
	
	<!-- We already have a Model object and it's saved into the variable $post 
	So what we can do?? We can bind the Model Object onto the form 
	We will use the Form Helpers
	-->
	<div class="row">
		<!-- Instead of doing Form::open() we write Form::model() 
		This tells Laravel that we are opening a Form but we need to connected to a Model that we are passing in  
		We still have access to all the Form helpers
	
		We must pass in the Object that we have in the form here that contains the model data
		-->
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
		<div class="col-md-8">
			<!-- null is the default value for the title -->
			{{ Form::label('title', "Title:") }}
			{{ Form::text('title', null, ["class" => 'form-control input-lg']) }}  
			<!-- -body -the name of the column in DB
				-null is the size of the textarea
				-['class' => 'form-control'] the bootstrap class

				'form-spacing-top' - we created in the css
				-->
			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control']) }}
		</div>

		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{ date( 'M j, Y h:ia', strtotime($post->created_at)) }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{ date( 'M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
						{{-- <a href="#" class="btn btn-primary btn-block">Edit</a> --}} 
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
						{{-- <a href="#" class="btn btn-danger btn-block">Delete</a> --}}
					</div>
				</div>


			</div>
		</div>
		{!! Form::close() !!}
	</div>  <!-- end of .row (form) -->

@stop