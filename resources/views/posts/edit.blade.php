@extends('main')

@section('title', '| Edit Blog Post')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

	<script>
		tinymce.init({
			selector: 'textarea',
			plugins: 'link code lists',
			menubar: false
		});
	</script>

@endsection

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
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
		<div class="col-md-8">
			<!-- null is the default value for the title -->
			{{ Form::label('title', "Title:") }}
			{{ Form::text('title', null, ["class" => 'form-control input-lg']) }}  
			<!-- -body -the name of the column in DB
				-null is the size of the textarea
				-['class' => 'form-control'] the bootstrap class

				'form-spacing-top' - we created in the css
				-->
			{{ Form::label('slug', 'Url:', ['class' => 'form-spacing-top']) }}
			{{ Form::text('slug', null, ['class' => 'form-control']) }}

			{{ Form::label('category_id', "Category:", ['class' => 'form-spacing-top']) }}
			{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

			{{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
			{{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

			{{ Form::label('featured_image', 'Update Featured Image:', ['class' => 'form-spacing-top']) }}
			{{ Form::file('featured_image') }}

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

@section('scripts')

	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
		
		// getRelatedIds - gives us an array of all the ids numbers for tags
		// json_encode - converts a php array into a JSON array
	</script>
@endsection