<?php
	$voornaam = "Didier";
	$achternaam = "De Maeyer";

	$volledigeNaam = $voornaam . $achternaam;

	$volledigeNaamLength = strlen($volledigeNaam);	//string length
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing String Concatenate</title>
</head>
<body>
	
	<p><?= $volledigeNaam ?></p>
	<p><?= $volledigeNaamLength ?></p>

</body>
</html>