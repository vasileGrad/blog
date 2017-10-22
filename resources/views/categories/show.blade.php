@extends('main')

@section('title', "| $category->name Category") 

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>{{ $category->name }} Category <small>{{ $category->posts()->count() }} Posts</small></h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary pull right btn-block margin-top-button">Edit</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<!-- We loop to every single post that is associated with our category -->
					@foreach ($category->posts as $post)
					<tr>
						<th>{{ $post->id }}</th>
						<td>{{ $post->title }}</td>
						
						<td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-xs">View</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection