<?php 

	session_start();

	if ( isset($_POST[ 'artikel-toevoegen' ]) ) {

		$titel = $_POST[ 'titel' ];
		$artikel = $_POST[ 'artikel' ];
		$kernwoorden = $_POST[ 'kernwoorden' ];
		$datum = $_POST[ 'datum' ];

		
		$db = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'root');

		$insertQuery = 'INSERT INTO artikels (titel, artikel, kernwoorden, datum)
											VALUES (:titel, :artikel, :kernwoorden, :datum)';
				
		$insertStatement = $db->prepare( $insertQuery );

		$insertStatement->bindParam(':titel', $titel);
		$insertStatement->bindParam(':artikel', $artikel);
		$insertStatement->bindParam(':kernwoorden', $kernwoorden);
		$insertStatement->bindParam(':datum', $datum);

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

 ?>