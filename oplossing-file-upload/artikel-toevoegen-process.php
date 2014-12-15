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



		/* Kijken of er wel langs het artikel-toevoegen form is gegaan */
		if ( isset($_POST[ 'artikel-toevoegen' ]) ) {

			/* Kijken of de inputvelden niet leeg zijn*/
			if ( 	!empty( $_POST[ 'titel' ])
						&& !empty( $_POST[ 'artikel' ])
						&& !empty( $_POST[ 'kernwoorden' ])
						&& !empty( $_POST[ 'datum' ]) ) {

				$titel = $_POST[ 'titel' ];
				$artikel = $_POST[ 'artikel' ];
				$kernwoorden = $_POST[ 'kernwoorden' ];
				$datum = $_POST[ 'datum' ];

				$datumExploded = explode('-', $datum);

				/* Kijken of de datum wel een correcte datum is */
				if ( 	strlen( $datumExploded[0] ) == 2
							&& strlen( $datumExploded[1] ) == 2
							&& strlen( $datumExploded[2] ) == 4
							&& checkdate( $datumExploded[1] , $datumExploded[0] , $datumExploded[2] ) ) {
					
					/* datum string in juiste volgorde zetten zodat */
					$datum = $datumExploded[2] . "-" . $datumExploded[1] . "-" . $datumExploded[0];

					$db = new Database( $connection );

					$queryString = 'INSERT INTO artikels (titel, artikel, kernwoorden, datum)
														VALUES (:titel, :artikel, :kernwoorden, :datum)';

					$parameters = array( 	':titel' 		=> $titel,
																':artikel'	=> $artikel,
																':kernwoorden'	=> $kernwoorden,
																':datum'		=> $datum );
					
					$artikelToegevoegd = $db->query( $queryString, $parameters );

					if ($artikelToegevoegd) {
						new Notification( 'succes', 'Het artikel werd succesvol toegevoegd.' );
					}
					else {
						new Notification( 'error', 'Er ging iets mis. Het artikel kon niet toegevoegd worden.' );
					}
				}
				else {
					new Notification( 'error', 'Er ging iets mis. De ingevulde tijd is fout.' );
				}	
				header('location: artikel-toevoegen-form.php');
			}
			else {
				new Notification( 'error', 'Er ging iets mis. Niet alle velden zijn ingevuld.' );
					
				header('location: artikel-toevoegen-form.php');
			}
		}


	}
	else {
		User::logout();
		$notification = new Notification( 'error', 'Er ging iets mis tijdens het inloggen. Probeer opnieuw');
		header('location: login-form.php');
	}

 ?>