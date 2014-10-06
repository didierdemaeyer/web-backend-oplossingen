<?php 
	$startGeld = 100000;

	function berekenRente($startGeld) 
	{
		static $aantalJaar = 1;
		if ($aantalJaar <= 10) 
		{
			$geld = floor( $startGeld * (1.08) );
			echo "<p>Geld na " . $aantalJaar . " jaar is " . $geld . "</p>";
			$aantalJaar++;
			berekenRente($geld);
		}

	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Deel 1</h1>
	<p>Startgeld: <?= $startGeld ?></p>
	<?= berekenRente($startGeld); ?>
</body>
</html>