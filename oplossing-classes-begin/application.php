<?php 
	function __autoload( $className ) {
	    include 'classes/' . $className . '.php';
	}

	$new = 150;
	$unit = 100;

	$percent = new Percent($new, $unit);
 ?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Oplossing Classes Begin</title>
 	<style>
 		table {
 			border-collapse: collapse;
 		}
 		
		table td {
			padding: 5px;
			border: 1px solid black;
		}
 	</style>
 </head>
 <body>
 	<p>Hoeveel procent is <?= $new ?> van <?= $unit ?>?</p>

 	<table>
 		<tr>
 			<td>Absoluut</td>
 			<td><?= $percent->absolute ?></td>
 		</tr>
 		<tr>
 			<td>Relatief</td>
 			<td><?= $percent->relative ?></td>
 		</tr>
 		<tr>
 			<td>Geheel getal</td>
 			<td><?= $percent->hundred ?>%</td>
 		</tr>
 		<tr>
 			<td>Nominaal</td>
 			<td><?= $percent->nominal ?></td>
 		</tr>
 	</table>
 </body>
 </html>