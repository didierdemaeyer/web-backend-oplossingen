@extends('layouts/main')

@section('head')
	@parent
	<title>Login - Periodeopdracht Todo</title>
@stop

@section('content')

	<h1>Meld je aan</h1>

	@foreach ($errors->all() as $error)
		<p class="modal error">{{ $error }}</p>
	@endforeach
	
	{{ Form::open() }}
		<ul>
			<li>
				<label for="email">Email</label>
				<input type="text" name="email">
			</li>
			<li>
				<label for="password">Password</label>
				<input type="password" name="password">
			</li>
		</ul>

		<input type="submit" value="Inloggen">
	{{ Form::close() }}

@stop