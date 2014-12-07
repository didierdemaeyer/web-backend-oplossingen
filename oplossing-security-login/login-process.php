<?php 
		
	session_start();

	if ( isset($_POST['inloggen']) ) {

		$email = $_POST['e-mail'];
		$paswoord = $_POST['paswoord'];

		$db = new PDO('mysql:host=localhost;dbname=opdracht-security-login', 'root', 'root');

		$emailQuery = 'SELECT * 
											FROM users
											WHERE email = :email';

		$emailStatement = $db->prepare( $emailQuery );

		$emailStatement->bindParam(':email', $email);

		$emailStatement->execute();

		$user = array();
		while ($row = $emailStatement->fetch( PDO::FETCH_ASSOC )) {		
			$user[] = $row;
		}
		var_dump($user);

		if ( isset($user[0]) ) {
			$salt = $user[0]['salt'];

			$hashedPassword = hash('SHA512', ($paswoord . $salt) );

			if ( $hashedPassword == $user['0']['hashed_password'] ) {
				/* COOKIE aanmaken geldig voor 30 dagen */
				$hashedEmail = hash( 'sha512', $salt . $email );
				$cookieValue = $email . "," . $hashedEmail;

				$cookie	=	setcookie( 'login', $cookieValue, time() + 2592000 );	/* => 30 * 24 * 60 * 60 == 30 dagen  */ 

				header('location: dashboard.php');
			}
			else {
				$_SESSION['notification']['type'] = "error";
				$_SESSION['notification']['message'] = "De combinatie van het e-mail adres en paswoord is fout. Probeer opnieuw";

				header('location: login-form.php');
			}

		}
		else {
			$_SESSION['notification']['type'] = "error";
			$_SESSION['notification']['message'] = "De combinatie van het e-mail adres en paswoord is fout. Probeer opnieuw";

			header('location: login-form.php');
		}
	}
	else {
		header('location: login-form.php');
	}

 ?>