<?php 

	session_start();


	/* Genereer paswoord */ 
	if ( isset($_POST['genereer-paswoord']) ) {
		$generatedPassword = generatePassword(10, true, true, true);

		$_SESSION['registratie']['e-mail'] = $_POST['e-mail'];
		$_SESSION['registratie']['paswoord'] = $generatedPassword;

		header('location: registratie-form.php');
	}

	/* Registreer */
	elseif ( isset($_POST['registreer']) ) {

		$email = $_POST['e-mail'];
		$paswoord = $_POST['paswoord'];

		$isEmail = filter_var($email, FILTER_VALIDATE_EMAIL);	/* checken of het wel een e-mail adres is */

		if ( !$isEmail ) {
			$_SESSION['notification']['type'] = "error";
			$_SESSION['notification']['message'] = "Het ingegeven e-mail adres is niet geldig. Vul een geldig e-mail adres in.";

			header('location: registratie-form.php');
		}
		elseif ( $paswoord == "") {
			$_SESSION['registratie']['e-mail'] = $_POST['e-mail'];
			$_SESSION['registratie']['paswoord'] = "";

			$_SESSION['notification']['type'] = "error";
			$_SESSION['notification']['message'] = "Het ingegeven paswoord is niet geldig. Vul een geldig paswoord in.";

			header('location: registratie-form.php');
		}
		else {

			$db = new PDO('mysql:host=localhost;dbname=opdracht-security-login', 'root', 'root');

			$emailQuery = 'SELECT * 
												FROM users
												WHERE email = :email';

			$emailStatement = $db->prepare( $emailQuery );

			$emailStatement->bindParam(':email', $email);

			$emailStatement->execute();

			/* Kijk of het e-mail adres al bestaat in de databank, als het bestaat wordt de database rij geplaatst in de array $users */
			$users = array();
			while ($row = $emailStatement->fetch( PDO::FETCH_ASSOC )) {		
				$users[] = $row;
			}
			// var_dump($users);

			if ( isset( $users[0] ) ) {	/* Als er iets in de array $users zit betekent dit dat het email adres al in de databank zit */
				$_SESSION['notification']['type'] = "error";
				$_SESSION['notification']['message'] = "Het ingegeven e-mail adres (" . $email . ") is reeds in gebruik.";

				header('location: registratie-form.php');
			}
			else {

				$salt = uniqid(mt_rand(), true);

				$hashedPaswoord = hash('SHA512', ($paswoord . $salt) );

				$insertQuery = 'INSERT INTO users (email, salt, hashed_password, last_login_time)
													VALUES (:email, :salt, :hashed_password, NOW())';
				
				$insertStatement = $db->prepare( $insertQuery );

				$insertStatement->bindParam(':email', $email);
				$insertStatement->bindParam(':salt', $salt);
				$insertStatement->bindParam(':hashed_password', $hashedPaswoord);

				$insertStatement->execute();

				/* COOKIE aanmaken geldig voor 30 dagen */
				$hashedEmail = hash( 'sha512', $salt . $email );
				$cookieValue = $email . "," . $hashedEmail;

				$cookie	=	setcookie( 'login', $cookieValue, time() + 2592000 );	/* => 30 * 24 * 60 * 60 == 30 dagen  */ 


				/* SESSION verwijderen zodat er geen foutmelding komt wanneer je terug op registratie pagina komt */
				session_destroy();

				header('location: dashboard.php');
			}

		}

	}
	else {
		header('location: login-form.php');
	}


	function generatePassword(	$lengte,
																		$hoofdletters = true,
																		$kleineLetters = true,
																		$cijfers = false,
																		$specialeTekens = false )
	{
		
		$paswoord = "";
		$paswoordKarakters = array();

		$karaktersHoofdletters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$karaktersKleineLetters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
		$karaktersCijfers = array(0,1,2,3,4,5,6,7,8,9);
		$karaktersSpecialeTekens = array('+','-','*','/','$','%','@','#','_');


		if ($hoofdletters) {
			for ($i=0; $i < count($karaktersHoofdletters); $i++) { 
				$paswoordKarakters[] = $karaktersHoofdletters[$i];
			}
		}

		if ($kleineLetters) {
			for ($i=0; $i < count($karaktersKleineLetters); $i++) { 
				$paswoordKarakters[] = $karaktersKleineLetters[$i];
			}
		}

		if ($cijfers) {
			for ($i=0; $i < count($karaktersCijfers); $i++) { 
				$paswoordKarakters[] = $karaktersCijfers[$i];
			}
		}

		if ($specialeTekens) {
			for ($i=0; $i < count($karaktersSpecialeTekens); $i++) { 
				$paswoordKarakters[] = $karaktersSpecialeTekens[$i];
			}
		}

		$aantalKarakters = 0;

		while ($aantalKarakters < $lengte) {

			$randomNummer = rand(0, (count($paswoordKarakters)-1) );

			$paswoord .= $paswoordKarakters[ $randomNummer ];

			$aantalKarakters++;
		}
		// var_dump($paswoordKarakters);
		// echo $paswoord;

		return $paswoord;
	}

	// generatePassword(20, true, true, true);

 ?>