@extends('main')

@section('title', '| Login')

@section('content')

	<h1 class="center-title">Sign In</h1>
	<div class="row">
		<div class="col-md-6 col-md-offset-3 form-spacing-top">
			{!! Form::open() !!} {{-- will add csrf_form protection and will open the form--}}

			{{ Form::label('email', 'Email:') }}
			{{ Form::email('email', null, ['class' => 'form-control']) }}

			{{ Form::label('password', 'Password:') }}
			{{ Form::password('password', ['class' => 'form-control']) }}

			<br>
			{{ Form::checkbox('remember') }}{{ Form::label('remember', 'Remember Me') }}

			<br>
			<div class="col-md-6 col-md-offset-3">
				{{ Form::submit('Login', ['class' => 'btn btn-primary btn-block']) }}
			</div>

			{!! Form::close() !!}
		</div>
	</div>
	 

@endsection