<?php 
		
	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	if ( isset($_SESSION['notification'])) {
		var_dump($_SESSION['notification']);
	}

	if ( isset($_POST['inloggen']) ) {

		$email = $_POST['e-mail'];
		$password = $_POST['paswoord'];

		$connection = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'root');

		$db = new Database( $connection );

		$queryString = 'SELECT * 
											FROM users
											WHERE email = :email';

		$parameters = array( ':email' => $email );

		$userData = $db->query( $queryString, $parameters );

		if ( isset($userData[ 'data' ][ 0 ]) ) {
			$salt = $userData[ 'data' ][ 0 ][ 'salt' ];

			$hashedPassword = hash( 'sha512', $password . $salt );

			var_dump( $userData );

			if ( $hashedPassword == $userData[ 'data' ][ 0 ][ 'hashed_password' ] ) {
				/* COOKIE aanmaken geldig voor 30 dagen */
				User::createCookie( $salt, $email);

				new Notification( 'succes', 'Welkom, u bent ingelogd.' );

				header('location: dashboard.php');
			}
			else {
				new Notification( 'error', 'De combinatie van het e-mail adres en paswoord is fout. Probeer opnieuw');

				header('location: login-form.php');
			}
		}
		else {
			new Notification( 'error', 'De combinatie van het e-mail adres en paswoord is fout. Probeer opnieuw');

			header('location: login-form.php');
		}
	}
	else {
		header('location: login-form.php');
	}


 ?>