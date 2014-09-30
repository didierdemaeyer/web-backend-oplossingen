<?php 
	//DEEL 1
	$jaartal = 2014;

	if ($jaartal % 400 == 0) {
		$melding = $jaartal . " is een schrikkeljaar.";
	}
	elseif ($jaartal % 100 == 0) {
		$melding = $jaartal . " is geen schrikkeljaar.";
	}
	elseif (($jaartal % 4) == 0) {
		$melding = $jaartal . " is een schrikkeljaar.";
	}
	else {
		$melding = $jaartal . " is geen schrikkeljaar.";
	}

	//DEEL 2
	$seconden = 221108521;
	
	$minuten = floor($seconden / 60);		//floor rond af
	$uren = floor($seconden / 3600);
	$dagen = floor($uren / 24);
	$weken = floor($dagen / 7);
	$maanden = floor($dagen / 31);
	$jaren = floor($maanden / 12);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing if else</title>
</head>
<body>
	<h1>Deel 1</h1>
	<p><?= $melding ?></p>

	<h1>Deel 2</h1>
	<p>in seconden: </p>
	<ul>
		<li>minuten: <?= $minuten ?></li>
		<li>uren: <?= $uren ?></li>
		<li>dagen: <?= $dagen ?></li>
		<li>weken: <?= $weken ?></li>
		<li>maanden: <?= $maanden ?></li>
		<li>jaren: <?= $jaren ?></li>
	</ul>       
</body>
</html>