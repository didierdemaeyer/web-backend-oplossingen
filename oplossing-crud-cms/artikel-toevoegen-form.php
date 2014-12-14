<?php 

	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$notification = null;

	$connection = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'root');

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
	<title>Artikel toevoegen - Oplossing CRUD CMS</title>
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

	<h1>Artikel toevoegen</h1>

	<?php if ( isset($notification) ): ?>
		<p class="<?= $notification[ 'type' ] ?>"><?= $notification[ 'message' ] ?></p>
	<?php endif ?>

	<form action="artikel-toevoegen-process.php" method="POST">
    <ul>
      <li>
		    <label for="titel">Titel</label>
		    <input id="titel" type="text" name="titel"></input>
			</li>
      <li>
        <label for="artikel">Artikel</label>
        <textarea id="artikel" name="artikel"></textarea>
      </li>
      <li>
        <label for="kernwoorden">Kernwoorden</label>
        <input id="kernwoorden" type="text" name="kernwoorden"></input>
      </li>
      <li>
        <label for="datum">Datum (dd-mm-jjjj)</label>
        <input id="datum" type="date" name="datum"></input>
      </li>
      <input type="submit" name="artikel-toevoegen" value="Artikel toevoegen"></input>
    </ul>
	</form>
	

</body>
</html>