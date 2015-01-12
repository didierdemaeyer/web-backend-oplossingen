@extends('layouts/main')

@section('head')
	@parent
	<title>Dashboard - Periodeopdracht Todo</title>
@stop

@section('content')

	<?php if ( Session::get('message') ): ?>
		<p class="modal success">{{ Session::get('message') }}</p>
	<?php endif ?>
	
	<h1>Dashboard</h1>

	<p>Bekijk je Todo's in de Todo Applicatie: {{ HTML::linkRoute('todo', 'To Do-App') }}</p>
	
@stop