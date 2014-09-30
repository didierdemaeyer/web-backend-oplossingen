<?php 
	//DEEL 1
	$jaartal = 2000;
	if ($jaartal % 4 == 0) {
		$boodschap = $jaartal . " is een schrikkeljaar.";
	}
	if ($jaartal % 100 == 0) {
		$boodschap = $jaartal . " is geen schrikkeljaar.";
	}
	if ($jaartal % 400 == 0) {
		$boodschap = $jaartal . " is een schrikkeljaar.";
	}
	else {
		$boodschap = $jaartal . " is geen schrikkeljaar.";
	}

	//DEEL 2
	$seconden = 221108521;
	$minuten = floor($seconden / 60);
	$uren = floor($seconden / 3600);
	$dagen = floor($uren / 24);
	$weken = floor($dagen / 7);
	$maanden = floor($dagen / 31);
	$jaren = floor($dagen / 365);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing if else</title>
</head>
<body>
	<h1>Deel 1</h1>
	<p><?= $boodschap ?></p>

	<h1>Deel 2</h1>
	<p>in seconden: <?= $seconden ?></p>
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