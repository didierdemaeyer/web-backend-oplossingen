<?php 
	//DEEL 1
	$dieren = array("hond", "kat", "koe", "paard", "geit", "hamster" );
	$aantalDieren = count($dieren);

	$teZoekenDier = "kat";
	$isGevonden;
	if (in_array($teZoekenDier, $dieren)) {
		$isGevonden = "gevonden";
	}
	elseif (!in_array($teZoekenDier, $dieren)) {
		$isGevonden = "niet gevonden";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing array functies</title>
</head>
<body>

	<h1>Deel 1</h1>
	<p><?= $aantalDieren ?></p>
	<p><?= $teZoekenDier ?> is <?= $isGevonden ?> in de array $dieren.</p>
	
</body>
</html>