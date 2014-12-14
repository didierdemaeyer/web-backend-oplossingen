<?php 

	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$notification = null;

	$connection = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'root');

	if ( User::validate( $connection ) ) {
		$notification = Notification::getNotification();

		$cookieExplode = explode( ',', $_COOKIE['login'] );		/* email adres uit cookie halen */
		$email = $cookieExplode[ 0 ];



		if ( isset($_GET['artikel']) ) {
			$artikelId = $_GET['artikel'];

			$db = new Database( $connection );

			$queryString = 	'SELECT * 
												FROM artikels 
												WHERE id = :id';

			$parameters = array( ':id' => $artikelId );

			$artikelData = $db->query( $queryString, $parameters );

			if ( $artikelData ) {
				$titel = $artikelData[ 'data' ][ 0 ][ 'titel' ];
				$artikel = $artikelData[ 'data' ][ 0 ][ 'artikel' ];
				$kernwoorden = $artikelData[ 'data' ][ 0 ][ 'kernwoorden' ];

				$datum = $artikelData[ 'data' ][ 0 ][ 'datum' ];
				$datumExploded = explode( '-', $datum );
				$datum = $datumExploded[2] . "-" . $datumExploded[1] . "-" . $datumExploded[0];		 //datum omdraaien van jjjj-mm-dd  =>  dd-mm-jjjj 
			}
		}
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
	<title>Artikel wijzigen - Oplossing CRUD CMS</title>
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
	<p>
		<a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?= $email ?> | <a href="logout.php">Uitloggen</a>
	</p>
	
	<a href="artikel-overzicht.php">Terug naar overzicht</a>

	<h1>Artikel wijzigen</h1>

	<?php if ( isset($notification) ): ?>
		<p class="<?= $notification[ 'type' ] ?>"><?= $notification[ 'message' ] ?></p>
	<?php endif ?>

	<form action="artikel-wijzigen.php" method="POST">
    <ul>
      <li>
		    <label for="titel">Titel</label>
		    <input id="titel" type="text" name="titel" value="<?= $titel ?>"></input>
			</li>
      <li>
        <label for="artikel">Artikel</label>
        <textarea id="artikel" name="artikel"><?= $artikel ?></textarea>
      </li>
      <li>
        <label for="kernwoorden">Kernwoorden</label>
        <input id="kernwoorden" type="text" name="kernwoorden" value="<?= $kernwoorden ?>"></input>
      </li>
      <li>
        <label for="datum">Datum (dd-mm-jjjj)</label>
        <input id="datum" type="date" name="datum" value="<?= $datum ?>"></input>
      </li>
			<input type="hidden" name="id" value="<?= $artikelId ?>">

      <input type="submit" name="artikel-wijzigen" value="Artikel wijzigen"></input>
    </ul>
	</form>
	

</body>
</html>