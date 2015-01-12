@extends('layouts/main')

@section('head')
	@parent
	<title>To Do App - periodeopdracht Todo</title>
@stop

@section('content')
	
	<?php if ( Session::get('message') ): ?>
		<p class="modal success">{{ Session::get('message') }}</p>
	<?php endif ?>

	<h1>To Do-App</h1>

	<!-- Tellen hoeveel items er in de variabele $items zitten is de manier dat je de session variabelen van laravel kan checken -->
	@if ( count( $items ) == 0 ) 
		
		<p>Nog geen todo-items. {{ HTML::linkRoute('todo/add', 'Voeg item toe') }}</p>

	@else

		<h2>Wat moet er allemaal gebeuren?</h2>

			{{ HTML::linkRoute('todo/add', 'Voeg item toe') }}

			<h3>Todo</h3>
			
			<ul class="list">
				@foreach( $items as $item )
					<?php if ( $item->done == 0 ): ?>

						<li class="todo">
							<span class="activate" title="Vink maar af">
								{{ HTML::linkRoute('todo/activate', '', array( 'id' => $item->id ), array( 'class' => 'icon fontawesome-ok-sign')) }}
							</span>
							<span class="text">{{ $item->name }}</span>
							<span class="delete" title="Verwijderen uit lijstje">
								{{ HTML::linkRoute('todo/delete', '', array( 'id' => $item->id ), array( 'class' => 'icon fontawesome-remove')) }}
							</span>
						</li>

					<?php endif ?>
				@endforeach
			</ul>


			<h3>Done</h3>

			<ul class="list">
				@foreach( $items as $item )
					<?php if ( $item->done == 1): ?>

						<li class="done">
							<span class="activate" title="Dit moet nog gedaan worden">
								{{ HTML::linkRoute('todo/activate', '', array( 'id' => $item->id ), array( 'class' => 'icon fontawesome-ok-sign')) }}
							</span>
							<span class="text">{{ $item->name }}</span>
							<span class="delete" title="Verwijderen uit lijstje">
								{{ HTML::linkRoute('todo/delete', '', array( 'id' => $item->id ), array( 'class' => 'icon fontawesome-remove')) }}
							</span>
						</li>

					<?php endif ?>
				@endforeach
			</ul>

	@endif

	

@stop