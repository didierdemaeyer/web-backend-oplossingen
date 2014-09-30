<?php
	//DEEL 1
	$fruit = "kokosnoot";

	$fruitLength = strlen($fruit);		//string length
	$fruitPosO = strpos($fruit, "o");	//zoekt op welke positie "o" de eerste keer voorkomt in de string

	//DEEL 2
	$fruit2 = "ananas";

	$fruit2PosA = strrpos($fruit2, "a");	//zoekt op welke positie "a" de laatste keer voorkomt
	$fruit2Uppercase = strtoupper($fruit2);	//maakt string uppercase

	//DEEL 3
	$lettertje = "e";
	$cijfertje = 3;
	$langstewoord = "zandzeepsodemineralenwatersteenstralen";

	$langstewoordReplaced = str_replace($lettertje, $cijfertje, $langstewoord);	//verander $lettertje met $cijfertje in de string $langstewoord
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<h1>Deel 1</h1>
	<p><?= $fruitLength ?></p>
	<p><?= $fruitPosO ?></p>

	<h1>Deel 2</h1>
	<p><?= $fruit2PosA ?></p>
	<p><?= $fruit2Uppercase ?></p>

	<h1>Deel 3</h1>
	<p><?= $langstewoordReplaced ?></p>

</body>
</html>