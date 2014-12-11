<?php 

	session_start();

	if ( isset($_GET['artikel']) ) {
		$artikelId = $_GET['artikel'];

		try 
		{
			$db = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'root');
		
			$updateQuery	=	'UPDATE artikels
													SET is_archived = 1
													WHERE id = :id
													LIMIT 1';

			$updateStatement = $db->prepare( $updateQuery );

			$updateStatement->bindValue(':id', $artikelId);

			$isUpdated = $updateStatement->execute();

			if ( $isUpdated ) {
				$_SESSION[ 'notification' ][ 'type' ] = "succes";
				$_SESSION[ 'notification' ][ 'message' ] = "Het artikel is verwijderd.";
			}
			else {
				$_SESSION[ 'notification' ][ 'type' ] = "error";
				$_SESSION[ 'notification' ][ 'message' ] = "Er ging iets mis. Het artikel is niet verwijderd.";
			}

			header('location: artikel-overzicht.php');
		} 
		catch (Exception $e) 
		{
			$_SESSION[ 'notification' ][ 'type' ] = "error";
			$_SESSION[ 'notification' ][ 'message' ] = "Er ging iets mis. Er kon niet worden geconnecteerd met de databank.";
		
			header('location: artikel-overzicht.php');
		}
	}
	else {
		
		header('location: artikel-overzicht.php');
	}
	
 ?>