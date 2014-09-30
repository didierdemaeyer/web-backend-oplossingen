<?php 
	$voornaam = "Didier";
	$achternaam = "De Maeyer";

	$volledigeNaam = $voornaam . " " . $achternaam;
	$aantalKarakters = strlen($volledigeNaam);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing string concatenate</title>
</head>
<body>
	<p><?= $volledigeNaam ?></p>
	<p><?= $aantalKarakters ?></p>
</body>
</html>