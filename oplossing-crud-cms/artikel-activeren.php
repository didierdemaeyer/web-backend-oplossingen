<?php 

	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$connection = new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', 'root');

	if ( User::validate( $connection )) {

		if ( isset($_GET['artikel']) ) {
			$artikelId = $_GET['artikel'];

			try 
			{
				$db = new Database( $connection );
		
				$queryString = 	'UPDATE artikels
													SET is_active = 1 - is_active
													WHERE id = :id
													LIMIT 1';

				$parameters = array( ':id' => $artikelId );

				$isActivated = $db->query( $queryString, $parameters );

				if ( $isActivated ) {
					new Notification( 'succes', 'Het artikel is geactiveerd.' );
				}
				else {
					new Notification( 'error', 'Er ging iets mis. Het artikel is niet geactiveerd.' );
				}

				header('location: artikel-overzicht.php');
			}
			catch (Exception $e) {
				new Notification( 'error', 'Er ging iets mis. Er kon niet worden geconnecteerd met de databank.' );
				header('location: artikel-overzicht.php');
			}
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