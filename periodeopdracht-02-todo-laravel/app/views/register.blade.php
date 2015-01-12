@extends('layouts/main')

@section('head')
	@parent
	<title>Registreer - Periodeopdracht Todo</title>
@stop

@section('content')

	<h1>Registreer</h1>

	@foreach ($errors->all() as $error)
		<?php if ( $error ): ?>
			<p class="error">{{ $error }}</p>
		<?php endif ?>
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

		<input type="submit" value="Registreer">
	{{ Form::close() }}

@stop