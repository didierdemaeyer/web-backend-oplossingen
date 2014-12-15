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



		$db = new Database( $connection );

		$queryString = 'SELECT * 
											FROM users
											WHERE email = :email';

		$parameters = array( ':email' => $email );

		$userData = $db->query( $queryString, $parameters );

		if ( $userData[ 'data' ][ 0 ][ 'profile_picture' ] == '' ) {
			$profilePicture = "img/placeholder_user.png";
		}
		else {
			$profilePicture = "img/" . $userData[ 'data' ][ 0 ][ 'profile_picture' ];
		}
		
		var_dump($userData[ 'data' ][ 0 ][ 'profile_picture' ]);

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
	<title>Gegevens wijzigen - Oplossing File Upload</title>
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
				width: 200px;
			}

			.profile-picture {
				display: block;
				width: 200px;
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

	<h1>Gegevens wijzigen</h1>

	<?php if ( isset($notification) ): ?>
		<p class="<?= $notification[ 'type' ] ?>"><?= $notification[ 'message' ] ?></p>
	<?php endif ?>

	<form action="gegevens-wijzigen-process.php" method="POST" enctype="multipart/form-data">
		
		<ul>
			<li>
				<label for="profile-picture">
					Profielfoto
					<img class="profile-picture" src="<?= $profilePicture ?>" alt="Profielfoto">
				</label>
				<input id="profile-picture" type="file" name="profile-picture">
			</li>
			<li>
				<label for="email">e-mail</label>
				<input id="email" type="text" name="email" value="<?= $email ?>">
			</li>
		</ul>
		<input type="submit" name="gegevens-wijzigen" value="Gegevens wijzigen">
	</form>
	

</body>
</html>