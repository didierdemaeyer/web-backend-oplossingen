<?php 

	function __autoload( $className ) {
	    include 'classes/' . $className . '.php';
	}

	//STAP 2
	$kermit 	= new Animal("Kermit", "male", 100);
	$dikkie 	= new Animal("Dikkie", "male", 90);
	$flipper 	= new Animal("Flipper", "female", 80);

	//STAP3
	$simba 	= new Lion("Simba", "male", 50, "Congo lion");
	$scar 	= new Lion("Scar", "male", 100, "Kenia lion");

	$zeke	= new Zebra("Zeke", "male", 70, "Quagga");
	$zana	= new Zebra("Zana", "female", 60, "Selous");

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing Classes Extends</title>
</head>
<body>
	<h1>Stap 2: Instanties van de Animal class</h1>
	<p><?= $kermit->getName() ?> is van het geslacht <?= $kermit->getGender() ?> en heeft momenteel <?= $kermit->getHealth() ?> levenspunten</p>
	<p><?= $dikkie->getName() ?> is van het geslacht <?= $dikkie->getGender() ?> en heeft momenteel <?= $dikkie->getHealth() ?> levenspunten</p>
	<p><?= $flipper->getName() ?> is van het geslacht <?= $flipper->getGender() ?> en heeft momenteel <?= $flipper->getHealth() ?> levenspunten</p>

	<?php 
		$kermit->changeHealth(-30);
		$flipper->changeHealth(15);
	 ?>

	<p><?= $kermit->getName() ?> wordt aangevallen, hij heeft nu <?= $kermit->getHealth() ?> levenspunten</p>
	<p><?= $flipper->getName() ?> gebruikt <?= $flipper->doSpecialMove() ?>, hij heeft nu <?= $flipper->getHealth() ?> levenspunten</p>

	<h1>Stap 3: Instanties van de Lion class</h1>
	<p>De speciale move van <?= $simba->getName() ?> (soort: <?= $simba->getSpecies() ?> ): <?= $simba->doSpecialMove() ?></p>
	<p>De speciale move van <?= $scar->getName() ?> (soort: <?= $scar->getSpecies() ?> ): <?= $scar->doSpecialMove() ?></p>

	<h1>Stap 3: Instanties van de Zebra class</h1>
	<p>De speciale move van <?= $zeke->getName() ?> (soort: <?= $zeke->getSpecies() ?> ): <?= $zeke->doSpecialMove() ?></p>
	<p>De speciale move van <?= $zana->getName() ?> (soort: <?= $zana->getSpecies() ?> ): <?= $zana->doSpecialMove() ?></p>
</body>
</html>