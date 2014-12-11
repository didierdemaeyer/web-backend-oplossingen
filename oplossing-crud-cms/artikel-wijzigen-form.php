<?php 

	session_start();

	$notificationType = null;
	$notificationMessage = null;

	if ( isset( $_SESSION[ 'notification'] ) ) {
		$notificationType = $_SESSION[ 'notification' ][ 'type' ];
		$notificationMessage = $_SESSION[ 'notification' ][ 'message' ];
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

		$emailStatement->bindValue(':email', $email);

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
				
				if ( isset($_GET['artikel']) ) {
					$artikelId = $_GET['artikel'];

					$artikelQuery = 'SELECT * 
														FROM artikels 
														WHERE id = :id';

					$artikelStatement = $db->prepare( $artikelQuery );

					$artikelStatement->bindValue(':id', $artikelId);

					$artikelStatement->execute();

					$artikelArray = array();
					while ($row = $artikelStatement->fetch( PDO::FETCH_ASSOC )) {		
						$artikelArray[] = $row;
					}

					var_dump($artikelArray);

					$titel = $artikelArray[0]['titel'];
					$artikel = $artikelArray[0]['artikel'];
					$kernwoorden = $artikelArray[0]['kernwoorden'];

					$datum = $artikelArray[0]['datum'];
					$datumExploded = explode('-', $datum);	
					$datum = $datumExploded[2] . "-" . $datumExploded[1] . "-" . $datumExploded[0];		/* datum omdraaien van jjjj-mm-dd  =>  dd-mm-jjjj */


				}

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

	<?php if ( isset($notificationMessage) ): ?>
		<p class="<?= $notificationType ?>"><?= $notificationMessage ?></p>
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