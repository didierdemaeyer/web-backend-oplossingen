<?php 
	$getal = 4;

	switch ($getal) {
		case '1':
			$dag = "maandag";
			break;
		case '2':
			$dag = "dinsdag";
			break;
		case '3':
			$dag = "woensdag";
			break;
		case '4':
			$dag = "donderdag";
			break;
		case '5':
			$dag = "vrijdag";
			break;
		case '6':
			$dag = "zaterdag";
			break;
		case '7':
			$dag = "zondag";
			break;
		default:
			# code...
			break;
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing Switch</title>
</head>
<body>
	<p><?= $dag ?></p>
</body>
</html>