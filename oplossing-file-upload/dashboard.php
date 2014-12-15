<?php 
	
	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$notification = null;

	$connection = new PDO('mysql:host=localhost;dbname=opdracht-file-upload', 'root', 'root');

	if ( User::validate( $connection )) {
		$notification = Notification::getNotification();

		$cookieExplode = explode( ',', $_COOKIE['login'] );		/* email adres uit cookie halen */
		$email = $cookieExplode[ 0 ];
	}
	else {
		User::logout();
		$notification = new Notification( 'error', 'Er ging iets mis tijdens het inloggen. Probeer opnieuw');
		header('location: login-form.php');
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard - Oplossing CRUD CMS</title>
	<style>
	
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

	<p>Ingelogd als <?= $email ?> | <a href="logout.php">Uitloggen</a></p>

	<h1>Dashboard</h1>

	<?php if ( isset($notification) ): ?>
		<p class="<?= $notification[ 'type' ] ?>"><?= $notification[ 'message' ] ?></p>
	<?php endif ?>

	<ul>
		<li><a href="artikel-overzicht.php">Artikels</a></li>
		<li><a href="gegevens-wijzigen-form.php">Gegevens wijzigen</a></li>
	</ul>

</body>
</html>