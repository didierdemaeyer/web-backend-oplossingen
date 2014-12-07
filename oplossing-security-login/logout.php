<?php 

	session_start();

	$_SESSION['notification']['type'] = "succes";
	$_SESSION['notification']['message'] = "U bent uitgelogd. Tot de volgende keer";

	setcookie('login', "", time() - 99999999);

	header('location: login-form.php');
	
 ?>