<?php 

	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

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
		$password = $_POST['paswoord'];

		$isEmail = filter_var($email, FILTER_VALIDATE_EMAIL);	/* checken of het wel een e-mail adres is */

		if ( !$isEmail ) {
			new Notification( 'error', 'Het ingegeven e-mail adres is niet geldig. Vul een geldig e-mail adres in.' );

			header('location: registratie-form.php');
		}
		elseif ( $password == '') {
			$_SESSION['registratie']['e-mail'] = $_POST['e-mail'];
			$_SESSION['registratie']['paswoord'] = '';

			new Notification( 'error', 'Het ingegeven paswoord is niet geldig. Vul een geldig paswoord in.' );

			header('location: registratie-form.php');
		}
		else {

			$connection = new PDO('mysql:host=localhost;dbname=opdracht-security-login', 'root', 'root');

			$db = new Database( $connection );

			$queryString = 'SELECT * 
												FROM users
												WHERE email = :email';

			$parameters = array( ':email' => $email );

			$userData = $db->query( $queryString, $parameters );

			/* Als er iets in de array $userData[ 'data' ] zit betekent dit dat het email adres al in de databank zit */
			if ( isset( $userData[ 'data' ][ 0 ] ) ) {	
				new Notification( 'error', 'Het ingegeven e-mail adres (' . $email . ') is reeds in gebruik.' );

				header('location: registratie-form.php');
			}
			else {
				User::createNewUser( $connection, $email, $password);
				
				new Notification( 'succes', 'Uw registratie is gelukt. Welkom.' );

				/* SESSION unsetten zodat er geen ingegeven paswoord en email komt wanneer je terug op registratie pagina komt */
				unset( $_SESSION[ 'registratie'] );

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