<?php 
	//DEEL 1
	$md5HashKey = "d1fa402db91a7a93c4f414b8278ce073";

	function Functie1($key)
	{
		global $md5HashKey;
		$count = substr_count($key, "2");
		return "<p>Functie 1: De needle '2' komt " . $count . " keer voor in de hash key '" . $md5HashKey . "'<p>";
	}
	function Functie2($key) 
	{
		global $md5HashKey;
		$count = substr_count($key, "8");
		return "<p>Functie 1: De needle '8' komt " . $count . " keer voor in de hash key '" . $md5HashKey . "'<p>";
	}
	function Functie3($key) 
	{
		global $md5HashKey;
		$count = substr_count($key, "a");
		return "<p>Functie 1: De needle 'a' komt " . $count . " keer voor in de hash key '" . $md5HashKey . "'<p>";
	}


	//DEEL 2
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing functies gevorderd</title>
</head>
<body>
	<h1>Deel 1</h1>
	<?= Functie1($md5HashKey); ?>
	<?= Functie2($md5HashKey); ?>
	<?= Functie3($md5HashKey); ?>

	
</body>
</html>