<?php 

	session_start();

	$notificationType = null;
	$notificationMessage = null;

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
				if ( isset($_SESSION['notification']) ) {
					$notificationType = $_SESSION[ 'notification' ][ 'type' ];
					$notificationMessage = $_SESSION[ 'notification' ][ 'message' ];
				}
				session_destroy();
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

	<?php if ( isset($notificationMessage) ): ?>
		<p class="<?= $notificationType ?>"><?= $notificationMessage ?></p>
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
        <input id="datum" type="text" name="datum"></input>
      </li>
      <input type="submit" name="artikel-toevoegen" value="Artikel toevoegen"></input>
    </ul>
	</form>
	

</body>
</html>