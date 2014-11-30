<?php 

	$message = "";

	$gekozenBrouwer = "";

	try 
	{
		$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', 'root');

		$queryString = "SELECT 	brouwernr,
														brnaam
								    	FROM brouwers
								    	WHERE 1";

		$statement = $db->prepare( $queryString );

		$statement->execute();

		$brouwers = array();

		while ($row = $statement->fetch()) {
			$brouwers[] = $row;
		}
		//var_dump($brouwers);

		$message = "Er is succesvol geconnecteerd naar de database";


		if (isset($_GET['brouwernr'])) {
			
			$bierenQueryString	=	'SELECT bieren.naam
															FROM bieren 
															WHERE bieren.brouwernr = :brouwernr';

			$bierenStatement = $db->prepare( $bierenQueryString );

			$bierenStatement->bindParam( ':brouwernr', $_GET[ 'brouwernr' ] );
		
			$gekozenBrouwer = $_GET['brouwernr'];
		}
		else {
			$bierenQueryString	=	'SELECT bieren.naam
															FROM bieren';

			$bierenStatement = $db->prepare( $bierenQueryString );
		}

		$bierenStatement->execute();


		//Plaats kolomnamen van bieren in bierenKolomNamen array
		$bierenKolomNamen = array();
		$bierenKolomNamen[] = "#";

		for ($columnNumber = 0; $columnNumber  < $bierenStatement->columnCount( );  ++$columnNumber) 
		{ 
			$bierenKolomNamen[] = $bierenStatement->getColumnMeta( $columnNumber )['name'];
		}

		//Plaats biernamen in bieren array
		$bieren	=	array();

		while( $row = $bierenStatement->fetch( PDO::FETCH_ASSOC ) )
		{
			$bieren[ ]	=	$row[ 'naam' ];
		}

	} 
	catch (Exception $e) 
	{
		$message = "Er ging iets mis: " . $e->getMessage();
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

 	<h1>CRUD query: deel 2</h1>
 	<p><?php echo $message ?></p>
	
	
	<form action="oplossing-crud-query-deel2.php" method="GET">
		<select name="brouwernr">
			<?php foreach ($brouwers as $key => $brouwer): ?>
				<option value="<?= $brouwer['brouwernr'] ?>" <?= ( $gekozenBrouwer === $brouwer['brouwernr'] ) ? 'selected' : '' ?> ><?php echo $brouwer['brnaam'] ?></option>
			<?php endforeach ?>
		</select>
		<input type="submit" value="Geef mij alle bieren van deze brouwerij">
	</form>

	<table>
		<thead>
			<tr>
				<?php foreach ($bierenKolomNamen as $kolomNaam): ?>
					<td><?php echo $kolomNaam ?></td>
				<?php endforeach ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($bieren as $key => $naam): ?>
				<tr>
					<td><?php echo ($key + 1) ?></td>
					<td><?php echo $naam ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

 </body>
 </html>