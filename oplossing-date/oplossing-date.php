<?php 
	//DEEL 1
	$hour = 22;
	$minute = 35;
	$second = 25;
	$day = 21;
	$month = 1;
	$year = 1904;

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);


	$timestampFormatted = date("d F Y, h:i:s a", $timestamp);

	//DEEL 2

	setlocale(LC_ALL, 'nl_NL');

	$timestampFormattedDutch = strftime("%B,%P", $timestamp);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing Date</title>
</head>
<body>
	<h1>Deel 1</h1>
	<p><?= $timestampFormatted ?></p>

	<h1>Deel 2</h1>
	<p><?= $timestampFormattedDutch ?></p>
</body>
</html>