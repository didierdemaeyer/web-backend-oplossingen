<?php 
	//DEEL 1
	$getallen = array();
	for ($i=0; $i <= 100; $i++) { 
		$getallen[] = $i;
	}
	$getallenReeks = implode(", ", $getallen);	//implode($glue, $pieces); zet alle elementen uit een array in een string

	$getallen2 = array();
	for ($i=0; $i <= 100; $i++) { 
		if (($i % 3) == 0 && $i > 40 && $i < 80) {
			$getallen2[] = $i;
		}
	}
	$getallenReeks2 = implode(", ", $getallen2);


	//DEEL 2
	$maxTafels = 10;
	$maxProduct = 10;
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing for</title>
	<style>
		.even {
			background-color: lightgreen;
		}
	</style>
</head>
<body>
	<h1>Deel 1</h1>
	<p><?= $getallenReeks ?></p>
	<p><?= $getallenReeks2 ?></p>

	<h1>Deel 2</h1>
	<table>
		<?php for ($tafel=1; $tafel <= $maxTafels ; $tafel++): ?>
			<tr>
				<?php for($product=1; $product <= $maxProduct; $product++): ?>
					<td class="<?= (($tafel * $product) % 2 == 0) ? 'even' : '' ?>" ><?= $tafel * $product ?></td>
				<?php endfor ?>
			</tr>
		<?php endfor ?>
	</table>
</body>
</html>