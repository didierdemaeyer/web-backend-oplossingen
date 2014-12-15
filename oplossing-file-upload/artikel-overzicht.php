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


		/* Artikels ophalen */
		$db = new Database( $connection );

		$queryString = 'SELECT * 
											FROM artikels
											WHERE is_archived = 0';

		$artikelData = $db->query( $queryString, null );
		$artikels = $artikelData[ 'data' ];

		// var_dump($artikels);

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
	<title>Overzicht Artikels - Oplossing CRUD CMS</title>
	<style>
		
		.active {
			background-color: #FAFAFA;
		}

		.inactive {
			background-color: #DDD;
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

	<p>
		<a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?= $email ?> | <a href="logout.php">Uitloggen</a>
	</p>

	<h1>Overzicht van de artikels</h1>

	<?php if ( isset($notification) ): ?>
		<p class="<?= $notification[ 'type' ] ?>"><?= $notification[ 'message' ] ?></p>
	<?php endif ?>

	<?php if ( empty($artikels) ): ?>
		<p>Geen artikels gevonden</p>
	<?php endif ?>
	

	<a href="artikel-toevoegen-form.php">Voeg een artikel toe</a>

	<?php foreach ($artikels as $key => $value): ?>
		<article class="<?= ($value[ 'is_active' ]) ? 'active' : 'inactive' ?>">
			<h3><?= $value[ 'titel' ] ?></h3>
			<ul>
				<li>Artikel: <?= $value[ 'artikel' ] ?></li>
				<li>Kernwoorden: <?= $value[ 'kernwoorden' ] ?></li>
				<li>Datum: <?= $value[ 'datum' ] ?></li>
			</ul>
			<a href="artikel-wijzigen-form.php?artikel=<?= $value[ 'id' ] ?>">artikel wijzigen</a> | 
			<a href="artikel-activeren.php?artikel=<?= $value[ 'id' ] ?>"><?= $value[ 'is_active' ] ? 'artikel deactiveren' : 'artikel activeren' ?></a> | 
			<a href="artikel-verwijderen.php?artikel=<?= $value[ 'id' ] ?>">artikel verwijderen</a>
		</article>
	<?php endforeach ?>

</body>
</html>