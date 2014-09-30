<?php 
	$getal = 80;

	if ($getal < 10) {
		$boodschap = "Het getal ligt tussen 0 en 10.";
	}
	elseif ($getal < 20) {
		$boodschap = "Het getal ligt tussen 10 en 20.";
	}
	elseif ($getal < 30) {
		$boodschap = "Het getal ligt tussen 20 en 30.";
	}
	elseif ($getal < 40) {
		$boodschap = "Het getal ligt tussen 30 en 40.";
	}
	elseif ($getal < 50) {
		$boodschap = "Het getal ligt tussen 40 en 50.";
	}
	elseif ($getal < 60) {
		$boodschap = "Het getal ligt tussen 50 en 60.";
	}
	elseif ($getal < 70) {
		$boodschap = "Het getal ligt tussen 60 en 70.";
	}
	elseif ($getal < 80) {
		$boodschap = "Het getal ligt tussen 70 en 80.";
	}
	elseif ($getal < 90) {
		$boodschap = "Het getal ligt tussen 80 en 90.";
	}
	elseif ($getal < 100) {
		$boodschap = "Het getal ligt tussen 90 en 100.";
	}

	$boodschap = strrev($boodschap);	//string reverse
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing if else if</title>
</head>
<body>
	<p><?= $boodschap ?></p>
</body>
</html>