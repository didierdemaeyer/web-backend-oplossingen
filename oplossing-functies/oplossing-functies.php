<?php 
	//DEEL 1
	function berekenSom($getal1, $getal2)
	{
		return $getal1 + $getal2;
	}

	function vermenigvuldig($getal1, $getal2)
	{
		return $getal1 * $getal2;
	}

	function isEven($getal)
	{
		return ($getal % 2 == 0);
	}

	function bewerkString($string)
	{
		$array["lengte"] = strlen($string);
		$array["uppercase"] = strtoupper($string);
		return $array;
	}

	$som = berekenSom(2, 8);
	$product = vermenigvuldig(3, 5);
	$isGetalEven = isEven(6);

	$string = "Dit is een string.";
	$stringBewerkt = bewerkString($string);


	//DEEL 2
	function drukArrayAf($array)
	{
		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing functies</title>
</head>
<body>
	<h1>Deel 1</h1>
	<p>2 + 8 = <?= $som ?></p>
	<p>3 * 5 = <?= $product ?></p>
	<p>6 is <?= $isGetalEven ? "even" : "oneven" ?></p>
	<p><?= $stringBewerkt["lengte"] ?></p>
	<p><?= $stringBewerkt["uppercase"] ?></p>

	<p><?php echo ?></p>

	<h1>Deel 2</h1>
</body>
</html>