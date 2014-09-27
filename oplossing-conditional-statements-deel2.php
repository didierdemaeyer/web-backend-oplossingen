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
	$dag_ALowercase = str_replace("A", "a", $dagUppercase);

	$dag_LastALowercase = substr_replace($dagUppercase, "a", strrpos($dagUppercase, "A"),1);	//substr_replace(string, replacement, start/offset, length)
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing Conditional Statements Deel 1</title>
</head>
<body>
	<p><?= $dagUppercase ?></p>
	<p><?= $dag_ALowercase ?></p>
	<p><?= $dag_LastALowercase ?></p>
</body>
</html>