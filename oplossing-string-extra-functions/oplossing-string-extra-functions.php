<?php 
	//DEEL 1
	$fruit = "kokosnoot";
	$fruitLength = strlen($fruit);	//string length
	$fruitPosO = strpos($fruit, "o");	//positie in string waar eerste "o" staat

	//DEEL 2
	$fruit2 = "ananas";
	$fruit2PosA = strrpos($fruit2, "a");	//positie in string waar laatste "a" staat
	$fruit2Uppercase = strtoupper($fruit2);	//string to uppercase

	//DEEL 3
	$lettertje = "e";
	$cijfertje = 3;
	$langstewoord = "zandzeepsodemineralenwatersteenstralen";

	$langstewoordReplace = str_replace($lettertje, $cijfertje, $langstewoord);	//verander alle $lettertje in $cijfertje in de string $langstewoord
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing string extra functions</title>
</head>
<body>
	<h1>Deel 1</h1>
	<p><?= $fruitLength ?></p>
	<p><?= $fruitPosO ?></p>

	<h1>Deel 2</h1>
	<p><?= $fruit2PosA ?></p>
	<p><?= $fruit2Uppercase ?></p>

	<h1>Deel 3</h1>
	<p><?= $langstewoordReplace ?></p>
</body>
</html>