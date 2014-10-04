<?php 
	//DEEL 1
	$dieren = array("vis", "kat", "koe", "paard", "geit", "hamster" );
	$aantalDieren = count($dieren);

	$teZoekenDier = "kat";
	$isGevonden;
	if (in_array($teZoekenDier, $dieren)) {
		$isGevonden = "gevonden";
	}
	elseif (!in_array($teZoekenDier, $dieren)) {
		$isGevonden = "niet gevonden";
	}

	//DEEL 2
	$dierenSorted = $dieren;
	sort($dierenSorted);

	$zoogdieren = array("beer", "hond", "tijger");
	$dierenLijst = array_merge($dieren, $zoogdieren);

	//DEEL 3
	$getallen = array(8, 7, 8, 7, 3, 2, 1, 2, 4);
	$getallenUniek = array_unique($getallen);
	$getallenSorted = $getallenUniek;
	sort($getallenSorted);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing array functies deel 1</title>
</head>
<body>

	<h1>Deel 1</h1>
	<p><?= $aantalDieren ?></p>
	<p><?= $teZoekenDier ?> is <?= $isGevonden ?> in de array $dieren.</p>

	<h1>Deel 2</h1>
	<p><?= var_dump($dierenSorted) ?></p>
	<p><?= var_dump($dierenLijst) ?></p>

	<h1>Deel 3</h1>
	<p>$getallenUniek: <?= var_dump($getallenUniek) ?></p>
	<p>$getallenSorted: <?= var_dump($getallenSorted) ?></p>
	
</body>
</html>