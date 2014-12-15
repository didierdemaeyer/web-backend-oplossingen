<?php 
	
	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$notification = null;

	$connection = new PDO('mysql:host=localhost;dbname=opdracht-file-upload', 'root', 'root');

	if ( User::validate( $connection ) ) {
		header('location: dashboard.php');
	}
	else {
		User::logout();
		$notification = Notification::getNotification();
	}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login - Oplossing Security Login</title>
	<style>
		
		form ul {
			position: relative;
			left: -40px;
		}

		form ul li {
			list-style: none;
		}
	
		form ul li label {
			display: block;
		}

		.error {
			padding-left: 10px;
			background-color: #F2DEDE;
			border: 1px solid #EED3D7;
			border-radius: 5px;
		}

		.succes {
			padding-left: 10px;
			background-color: #90EE90;
			border-radius: 5px;
		}

	</style>
</head>
<body>
	<h1>Inloggen</h1>

	<?php if ( $notification ): ?>
		<p class="<?= $notification[ 'type' ] ?>"><?= $notification[ 'message' ] ?></p>
	<?php endif ?>

	<form action="login-process.php" method="POST">
		<ul>
			<li>
				<label for="e-mail">e-mail</label>
				<input type="text" id="e-mail" name="e-mail">
			</li>

			<li>
				<label for="paswoord">paswoord</label>
				<input type="password" id="paswoord" name="paswoord">
			</li>
		</ul>

		<input type="submit" name="inloggen" value="Inloggen">
	</form>

	<p>Nog geen account? Maak er dan eentje aan op de <a href="registratie-form.php">registratiepagina</a></p>

</body>
</html>