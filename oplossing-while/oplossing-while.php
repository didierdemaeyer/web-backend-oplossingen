<?php 
	//DEEL 1
	$getal = 0;
	$getal2 = 0;

	//DEEL 2
	$tafel = 1;
	$maxTafels = 10;
	$maxProduct = 10;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing while</title>
	<style>
		.even {
			background-color: lightgreen;
		}
	</style>
</head>
<body>
	<h1>Deel 1</h1>
	<p>
	<?php while ($getal <= 100): ?>
	<?= $getal ?>, 
	<?php $getal++ ?>
	<?php endwhile ?>
	</p>
	<p>
	<?php while ($getal2 <= 100): ?>
		<?php 
			if ($getal2 > 40 && $getal2 < 80 && ($getal2 % 3) ==0) {
				echo $getal2 . ", ";
			}
			$getal2++
		?>
	<?php endwhile ?>
	</p>

	<h1>Deel 2</h1>
	<table>
		<?php  while ($tafel <= $maxTafels): ?>
			<tr>
				<?php $product = 1; ?>
				<?php while ($product <= $maxProduct): ?>
					<td class="<?= (($tafel * $product) % 2 == 0) ? 'even' : '' ?>"><?= $tafel * $product ?></td>
					<?php $product++ ?>
				<?php endwhile ?>
			</tr>
			<?php $tafel++ ?>
		<?php endwhile ?>
	</table>
</body>
</html>