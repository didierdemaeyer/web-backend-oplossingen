<?php 

	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$connection = new PDO('mysql:host=localhost;dbname=opdracht-file-upload', 'root', 'root');

	if ( User::validate( $connection )) {
		
		if ( isset($_POST[ 'artikel-wijzigen' ]) ) {
			$artikelId = $_POST[ 'id' ];

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
					
					/* datum string in juiste volgorde zetten zodat het door de databank geaccepteerd wordt */
					$datum = $datumExploded[2] . "-" . $datumExploded[1] . "-" . $datumExploded[0];

					$db = new Database( $connection );

					$queryString = 	'UPDATE artikels
														SET titel = :titel,
																artikel	= :artikel,
																kernwoorden = :kernwoorden,
																datum = :datum
														WHERE id = :id
														LIMIT 1';

					$parameters = array( 	':titel' 		=> $titel,
																':artikel' 	=> $artikel,
																':kernwoorden' => $kernwoorden,
																':datum' => $datum,
																':id' => $artikelId );

					$artikelGewijzigd = $db->query( $queryString, $parameters );

					if ( $artikelGewijzigd ) {
						new Notification( 'succes', 'Het artikel werd succesvol gewijzigd.' );
					}
					else {
						new Notification( 'error', 'Er ging iets mis. Het artikel is niet gewijzigd.' );
					}
				}
				else {
					new Notification( 'error', 'Er ging iets mis. De ingevulde tijd is fout.' );
				}
			}
			else {
				new Notification( 'error', 'Er ging iets mis. Niet alle velden zijn ingevuld.' );
			}

			header('location: artikel-wijzigen-form.php?artikel=' . $artikelId);
		}
		else {
			header('location: artikel-overzicht.php');
		}
	}
	else {
		User::logout();
		$notification = new Notification( 'error', 'Er ging iets mis tijdens het inloggen. Probeer opnieuw');
		header('location: login-form.php');
	}

 ?>