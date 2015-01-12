@extends('layouts/main')

@section('head')
	@parent
	<title>Voeg een item toe - periodeopdracht Todo</title>
@stop

@section('content')

	<h1>Voeg een Todo-item toe</h1>
	
	{{ HTML::linkRoute('todo', "Terug naar mijn Todo's") }}

	@foreach ($errors->all() as $error)
		<p class="modal error">{{ $error }}</p>
	@endforeach

	{{ Form::open() }}
		<ul>
			<li>
				<label for="description">Wat moet er gedaan worden?</label>
				<input type="text" name="description">
			</li>
		</ul>

		<input type="submit" value="Toevoegen">
	{{ Form::close()}}

@stop