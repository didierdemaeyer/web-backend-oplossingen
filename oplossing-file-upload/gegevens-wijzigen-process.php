<?php 

	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$connection = new PDO('mysql:host=localhost;dbname=opdracht-file-upload', 'root', 'root');

	if ( User::validate( $connection )) {


		if ( isset($_POST[ 'gegevens-wijzigen' ]) ) {
			
			if ( (($_FILES[ 'profile-picture' ][ 'type' ] == "image/gif")
			|| 		($_FILES[ 'profile-picture' ][ 'type' ] == "image/jpeg")
			|| 		($_FILES[ 'profile-picture' ][ 'type' ] == "image/png"))
			&& 		($_FILES[ 'profile-picture' ][ 'size' ] < 2000000) ) 
			{
				define('ROOT', dirname(__FILE__));
				

				$cookieExplode = explode( ',', $_COOKIE['login'] );		/* email adres uit cookie halen */
				$current_email = $cookieExplode[ 0 ];

				$new_email = $_POST[ 'email' ];

				$timestamp = time();

				$bestandsnaam = $timestamp . "_" . $_FILES[ 'profile-picture' ][ 'name' ];

				if ( file_exists( ROOT . "/img/" . $bestandsnaam ) ) {
					$timestamp = time();

					$bestandsnaam = $timestamp . "_" . $_FILES[ 'profile-picture' ][ 'name' ];
				}
			
				$db = new Database( $connection );



				/* Vorige profielfoto selecteren en verplaatsen naar prullenbak */
				$queryString = 'SELECT profile_picture
													FROM users
													WHERE email = :current_email';

				$parameters = array( ':current_email' => $current_email );

				$userData = $db->query( $queryString, $parameters );

				$old_profile_picture = $userData[ 'data' ][ 0 ][ 'profile_picture' ];

				unlink( ROOT . "/img/" . $old_profile_picture );	//verwijder de oude profile_picture van de server



				/* verandering van email en profile_picture uploaden naar server */
				$queryString = 'UPDATE users
													SET email = :new_email,
															profile_picture	= :profile_picture
													WHERE email = :current_email
													LIMIT 1';

				$parameters = array( 	':new_email' 		=> $new_email,
															':profile_picture' 	=> $bestandsnaam,
															':current_email' => $current_email );
			
				$gegevensGewijzigd = $db->query( $queryString, $parameters );

				if ( $gegevensGewijzigd ) {
					move_uploaded_file( $_FILES[ 'profile-picture' ][ 'tmp_name' ], ROOT . "/img/" . $bestandsnaam );


					/* Nieuwe COOKIE aanmaken met het nieuwe email adres zodat de user niet uitgelogd wordt */
					$queryString = 'SELECT * 
														FROM users
														WHERE email = :new_email';

					$parameters = array( ':new_email' => $new_email );

					$userData = $db->query( $queryString, $parameters );

					$salt = $userData[ 'data' ][ 0 ][ 'salt' ];

					User::createCookie( $salt, $new_email);
					

				 	new Notification( 'succes', 'Gegevens werden succesvol gewijzigd.' );
			 	} 
				else {
					new notification( 'error', 'Er ging iets mis. Gegevens zijn niet gewijzigd.' );
				}

				header('location: gegevens-wijzigen-form.php');
			}
			else {
				new Notification( 'error', 'Het bestand is niet van het juiste bestandstype (gif, jpeg of png) of is groter dan 2MB.' );
			
				header('location: gegevens-wijzigen-form.php');
			}

		}


	}
	else {
		User::logout();
		$notification = new Notification( 'error', 'Er ging iets mis tijdens het inloggen. Probeer opnieuw');
		header('location: login-form.php');
	}
	

 ?>