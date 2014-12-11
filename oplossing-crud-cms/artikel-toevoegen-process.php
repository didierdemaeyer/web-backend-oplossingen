<?php 

	session_start();

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

				$db = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'root');

					$insertQuery = 'INSERT INTO artikels (titel, artikel, kernwoorden, datum)
														VALUES (:titel, :artikel, :kernwoorden, :datum)';
							
					$insertStatement = $db->prepare( $insertQuery );

					$insertStatement->bindValue(':titel', $titel);
					$insertStatement->bindValue(':artikel', $artikel);
					$insertStatement->bindValue(':kernwoorden', $kernwoorden);
					$insertStatement->bindValue(':datum', $datum);

					$artikelToegevoegd = $insertStatement->execute();

					if ($artikelToegevoegd) {
						$_SESSION[ 'notification' ][ 'type' ] = "succes";
						$_SESSION[ 'notification' ][ 'message' ] = "Het artikel werd succesvol toegevoegd.";
					}
					else {
						$_SESSION[ 'notification' ][ 'type' ] = "error";
						$_SESSION[ 'notification' ][ 'message' ] = "Er ging iets mis. Het artikel kon niet toegevoegd worden.";
					}

					header('location: artikel-toevoegen-form.php');
				}
				else {
					$_SESSION[ 'notification' ][ 'type' ] = "error";
					$_SESSION[ 'notification' ][ 'message' ] = "Er ging iets mis. De ingevulde tijd is fout.";
				}	
			
		}
		else {
			$_SESSION[ 'notification' ][ 'type' ] = "error";
			$_SESSION[ 'notification' ][ 'message' ] = "Er ging iets mis. Niet alle velden zijn ingevuld.";
			
			header('location: artikel-toevoegen-form.php');
		}
	}

 ?>