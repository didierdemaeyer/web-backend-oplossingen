<?php 
	//DEEL 1
	$dieren = array("hond", "kat", "hamster", "cavia", "paard", "koe", "schaap", "geit");
	$dieren[] = "leeuw";
	$dieren[] = "aap";

	$voertuigen = array("landvoertuigen" => array("Vespa", "fiets"), "watervoertuigen" => array("surfplank", "vlot", "driemaster"), "luchtvoertuigen" => array("luchtballon", "helicopter"));

	//DEEL 2
	$getallen = array(1, 2, 3, 4, 5);
	$getallen2 = array(5, 4, 3, 2, 1);
	$getallenOpgeteld;
	$getallenProduct = 1;
	$onevenGetallen;

	for ($i=0; $i < count($getallen); $i++) { 	//count lengte
		if ($getallen[$i] % 2 != 0) {
				$onevenGetallen[] = $getallen[$i];
		}
	}

	for ($i=0; $i < count($getallen); $i++) { 	//count lengte
		$getallenProduct *= $getallen[$i];
	}

	for ($i=0; $i < count($getallen); $i++) { 
		$getallenOpgeteld[] = $getallen[$i] + $getallen2[$i];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing arrays basis</title>
</head>
<body>
	<h1>Deel 1</h1>
	<p><?= var_dump($dieren) ?></p>
	<p><?= var_dump($voertuigen) ?></p>
	
	<h1>Deel 2</h1>
	<p><?= $getallenProduct ?></p>
	<p><?= var_dump($onevenGetallen) ?></p>
	<p><?= var_dump($getallenOpgeteld) ?></p>
</body>
</html>