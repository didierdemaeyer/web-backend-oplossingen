<?php 
	
	session_start();

	$notificationType = null;
	$notificationMessage = null;
	$email = "";
	$paswoord = "";

	if ( isset($_COOKIE['login']) ) {
		header('location: dashboard.php');
	}
	else {
		if ( isset($_SESSION['notification']) ) {
			$notificationType = $_SESSION['notification']['type'];
			$notificationMessage = $_SESSION['notification']['message'];

			/* SESSION verwijderen nadat je de notificationMessage en Type hebt gezet,
					zodat je niet elke keer de notification message opnieuw te zien krijgt als je refresht */
			session_destroy();	
		}
	}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login - Oplossing CRUD CMS</title>
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

	<?php if ( $notificationMessage ): ?>
		<p class="<?= $notificationType ?>"><?= $notificationMessage ?></p>
	<?php endif ?>

	<form action="login-process.php" method="POST">
		<ul>
			<li>
				<label for="e-mail">e-mail</label>
				<input type="text" id="e-mail" name="e-mail" value="<?= $email ?>">
			</li>

			<li>
				<label for="paswoord">paswoord</label>
				<input type="password" id="paswoord" name="paswoord" value="<?= $paswoord ?>">
			</li>
		</ul>

		<input type="submit" name="inloggen" value="Inloggen">
	</form>

	<p>Nog geen account? Maak er dan eentje aan op de <a href="registratie-form.php">registratiepagina</a></p>

</body>
</html>