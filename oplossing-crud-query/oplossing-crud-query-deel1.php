<?php 
	
	$message = "";

	try 
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'root');

		$queryString = "SELECT * 
											FROM `bieren` 
									    INNER JOIN brouwers
									    ON bieren.brouwernr = brouwers.brouwernr
									    WHERE bieren.naam LIKE 'du%'
									    AND	brouwers.brnaam LIKE '%a%'";

		$statement = $db->prepare( $queryString );

		$statement->execute();

		$bieren = array();

		while ($row = $statement->fetch( PDO::FETCH_ASSOC )) {
			$bieren[] = $row;
		}
		//var_dump($bieren);

		$kolomNamen = array();
		$kolomNamen[] = "#";

		foreach ($bieren[0] as $key => $value) {
			$kolomNamen[] = $key;
		}

		$message = "Er is succesvol geconnecteerd naar de database";
	} 
	catch (Exception $e) 
	{
		$message = "Er ging iets mis: " + $e->getMessage();
	}


 ?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Oplossing crud query</title>
	<style>
		
		table {
			border-collapse: collapse;
		}
		
		th {
			background-color: grey;
			padding: 5px;
			border: 1px solid black;
		}

		td {
			padding: 5px;
			border: 1px solid grey;
		}

		tr:nth-child(odd) {
			background-color: lightgrey;
		}

	</style>
 </head>
 <body>

 	<h1>CRUD query: deel 1</h1>
 	<p><?php echo $message ?></p>

 	<table>
 		<thead>
 			<tr>
 				<?php foreach ($kolomNamen as $key): ?>
 					<th><?php echo $key ?></th>
 				<?php endforeach ?>
 			</tr>
 		</thead>

 		<tbody>
 			<?php foreach ($bieren as $key => $bier): ?>
 				<tr>		<!-- class="... ($key + 1) % 2 == 0 ? 'even' : '' ?>" -->
 					<td><?php echo ($key + 1) ?></td>
 					<?php foreach ($bier as $value): ?>
 						<td><?php echo $value ?></td>
 					<?php endforeach ?>
 				</tr>
 			<?php endforeach ?>
 		</tbody>
 	</table>
 </body>
 </html>