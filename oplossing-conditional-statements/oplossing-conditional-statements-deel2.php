<?php 
	$getal = 1;
	if ($getal == 1) {
		$dag = "maandag";
	}
	if ($getal == 2) {
		$dag = "dinsdag";
	}
	if ($getal == 3) {
		$dag = "woensdag";
	}
	if ($getal == 4) {
		$dag = "donderdag";
	}
	if ($getal == 5) {
		$dag = "vrijdag";
	}
	if ($getal == 6) {
		$dag = "zaterdag";
	}
	if ($getal == 7) {
		$dag = "zondag";
	}

	$dagUppercase = strtoupper($dag);
	$dagALowercase = str_replace("A", "a", strtoupper($dag));
	$dagLastALowercase = substr_replace(strtoupper($dag), "a", strrpos($dag, "a"), 1);		//substr_replace(string, replacement, start, length);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing conditional statements deel 1</title>
</head>
<body>
	<p><?= $dagUppercase ?></p>
	<p><?= $dagALowercase ?></p>
	<p><?= $dagLastALowercase ?></p>
</body>
</html>