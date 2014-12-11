<?php 
	
	session_start();

	$notificationType = null;
	$notificationMessage = null;

	if ( isset($_SESSION['notification'] )) {
		$notificationType = $_SESSION[ 'notification' ][ 'type' ];
		$notificationMessage = $_SESSION[ 'notification' ][ 'message' ];

		session_destroy();
	}

	if ( isset($_COOKIE['login']) ) {

		$userArray = explode( ',', $_COOKIE['login'] );

		$email = $userArray[0];
		$saltedEmail = $userArray[1];

		$db = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'root');

		$emailQuery = 'SELECT * 
											FROM users
											WHERE email = :email';

		$emailStatement = $db->prepare( $emailQuery );

		$emailStatement->bindParam(':email', $email);

		$emailStatement->execute();

		/* Kijk of het e-mail adres al bestaat in de databank, als het bestaat wordt de database rij geplaatst in de array $users */
		$user = array();
		while ($row = $emailStatement->fetch( PDO::FETCH_ASSOC )) {		
			$user[] = $row;
		}
		// var_dump($user);

		if ( isset($user[0]) ) {
			$salt = $user[0]['salt'];

			$saltedEmailNew = hash( 'sha512' , $salt . $email );

			if ( $saltedEmailNew == $saltedEmail) {
				
				$artikelQuery = 'SELECT * 
													FROM artikels
													WHERE is_archived = 0';

				$artikelStatement = $db->prepare( $artikelQuery );

				$artikelStatement->execute();

				$artikels = array();
				while ($row = $artikelStatement->fetch( PDO::FETCH_ASSOC )) {
					$artikels[] = $row;
				}

				var_dump($artikels);



			}
			else {
				setcookie('login', "", time() - 99999999);
				header('location: login-form.php');
			}
		}
		else {
			setcookie('login', "", time() - 99999999);
			header('location: login-form.php');
		}
	}
	else {
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

	<a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?= $email ?> | <a href="logout.php">Uitloggen</a>

	<h1>Overzicht van de artikels</h1>

	<?php if ( isset($notificationMessage) ): ?>
		<p class="<?= $notificationType ?>"><?= $notificationMessage ?></p>
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