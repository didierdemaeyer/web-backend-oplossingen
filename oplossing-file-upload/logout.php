<?php 

	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$logout = User::logout();

	if ( $logout ) {
		$notification = new Notification( 'succes', 'U bent uitgelogd. Tot de volgende keer.');
	}
	
	header('location: login-form.php');
	
 ?>