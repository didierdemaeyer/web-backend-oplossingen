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
		if ( isset($_SESSION['registratie']) ) {
			$email = $_SESSION['registratie']['e-mail'];
			$paswoord = $_SESSION['registratie']['paswoord'];
		}

		if ( isset($_SESSION['notification']) ) {
			$notificationType = $_SESSION['notification']['type'];
			$notificationMessage = $_SESSION['notification']['message'];
		}
	}

	

	var_dump($_SESSION);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registratie - Oplossing CRUD CMS</title>
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

	</style>
</head>
<body>
	<h1>Registreren</h1>

	<?php if ( $notificationMessage ): ?>
		<p class="<?= $notificationType ?>"><?= $notificationMessage ?></p>
	<?php endif ?>

	<form action="registratie-process.php" method="POST">
		<ul>
			<li>
				<label for="e-mail">e-mail</label>
				<input type="text" id="e-mail" name="e-mail" value="<?= $email ?>">
			</li>

			<li>
				<label for="paswoord">paswoord</label>
				<input type="<?= ($paswoord != '') ? 'text' : 'password' ?>" id="paswoord" name="paswoord" value="<?= $paswoord ?>">
				<input type="submit" name="genereer-paswoord" value="Genereer een paswoord">
			</li>
		</ul>

		<input type="submit" name="registreer" value="Registreer">


	</form>
</body>
</html>