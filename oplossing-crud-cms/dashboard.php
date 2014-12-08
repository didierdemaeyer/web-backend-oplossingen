<?php 
	
	$message = null;

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
				$message = "Welkom.";
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
	<title>Dashboard - Oplossing CRUD CMS</title>
</head>
<body>

	<a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?= $email ?> | <a href="logout.php">Uitloggen</a>

	<h1>Dashboard</h1>

	<?php if ( isset($message) ): ?>
		<p><?= $message ?></p>
	<?php endif ?>

	<ul>
		<li><a href="artikel-overzicht.php">Artikels</a></li>
	</ul>

</body>
</html>