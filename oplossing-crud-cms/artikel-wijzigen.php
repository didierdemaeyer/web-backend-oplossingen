<?php 

	session_start();

	if ( isset($_POST[ 'artikel-wijzigen' ]) ) {

		/* Kijken of de inputvelden niet leeg zijn*/
		if ( 	!empty( $_POST[ 'titel' ])
					&& !empty( $_POST[ 'artikel' ])
					&& !empty( $_POST[ 'kernwoorden' ])
					&& !empty( $_POST[ 'datum' ]) ) {

			$artikelId = $_POST[ 'id' ];
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

				$db = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'root');

					$updateQuery = 'UPDATE artikels
														SET titel = :titel,
																artikel	= :artikel,
																kernwoorden = :kernwoorden,
																datum = :datum
														WHERE id = :id
														LIMIT 1';
							
					$updateStatement = $db->prepare( $updateQuery );

					$updateStatement->bindValue(':titel', $titel);
					$updateStatement->bindValue(':artikel', $artikel);
					$updateStatement->bindValue(':kernwoorden', $kernwoorden);
					$updateStatement->bindValue(':datum', $datum);
					$updateStatement->bindValue(':id', $artikelId);

					$artikelGewijzigd = $updateStatement->execute();

					if ($artikelGewijzigd) {
						$_SESSION[ 'notification' ][ 'type' ] = "succes";
						$_SESSION[ 'notification' ][ 'message' ] = "Het artikel werd succesvol gewijzigd.";
					}
					else {
						$_SESSION[ 'notification' ][ 'type' ] = "error";
						$_SESSION[ 'notification' ][ 'message' ] = "Er ging iets mis. Het artikel is niet gewijzigd.";
					}
				}
				else {
					$_SESSION[ 'notification' ][ 'type' ] = "error";
					$_SESSION[ 'notification' ][ 'message' ] = "Er ging iets mis. De ingevulde tijd is fout.";
				}
		}
		else {
			$_SESSION[ 'notification' ][ 'type' ] = "error";
			$_SESSION[ 'notification' ][ 'message' ] = "Er ging iets mis. Niet alle velden zijn ingevuld.";
		}

		header('location: artikel-wijzigen-form.php?artikel=' . $artikelId);
	}
	else {
		header('location: artikel-overzicht.php');
	}

 ?>