<!DOCTYPE html>
<html lang="en">
<head>
	@section('head')
		<meta charset="UTF-8">
		{{ HTML::style('css/style.css') }}
	@show
</head>
<body>

	<div class="container">	

		<header class="group">
			<div>
				{{ HTML::linkRoute('/', 'Home') }}
			</div>
			<nav>
				<ul>
					<?php if ( Auth::check() ): ?>
						<li>{{ HTML::linkRoute('dashboard', 'Dashboard') }}</li>
						<li>{{ HTML::linkRoute('todo', 'To Do-App') }}</li>
						<li>{{ HTML::linkRoute('logout', 'Logout (' . Auth::user()->email . ')' ) }}</li>
					<?php else: ?>
						<li>{{ HTML::linkRoute('login', 'Login') }}</li>
						<li>{{ HTML::linkRoute('register', 'Register') }}</li>
					<?php endif ?>
					
				</ul>
			</nav>
		</header>	

		<div class="body">

			@yield('content')

		</div>

	</div>
	
</body>
</html>