@extends('layouts/main')

@section('head')
	@parent
	<title>Home - Periodeopdracht Todo</title>
@stop

@section('content')

	<?php if ( Session::get('message') ): ?>
		<p class="modal success">{{ Session::get('message') }}</p>
	<?php endif ?>

	<h1>Welkom</h1>
	<p>Dit is de tweede periode-opdracht voor het vak Web-Backend, gemaakt met laravel.</p>

@stop