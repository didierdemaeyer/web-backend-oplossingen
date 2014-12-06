<?php 
	
	$message = null;

	try 
	{
		$db = new PDO("mysql:host=localhost;dbname=bieren", "root", "root");

		$orderKolom = "bieren.biernr";
		$order 			= "ASC";

		if ( isset($_GET['orderBy']) ) {
			var_dump($_GET['orderBy']);

			$orderArray = explode("-", $_GET['orderBy']);

			var_dump($orderArray);
			if ($orderKolom != $orderArray[0]) {
				$order = "ASC";
			}
			else {
				$order 			= $orderArray[1];
			}
			$orderKolom	= $orderArray[0];
			

			$order = ($orderArray[1] == "ASC") ? "DESC" : "ASC";
		}

		$orderQuery = "ORDER BY " . $orderKolom . " " . $order;

		$selectQuery = "SELECT 	bieren.biernr,
														bieren.naam,
														brouwers.brnaam,
														soorten.soort,
														bieren.alcohol 
											FROM bieren
											INNER JOIN brouwers
											ON bieren.brouwernr = brouwers.brouwernr
											INNER JOIN soorten
											ON bieren.soortnr = soorten.soortnr "
											. $orderQuery;

		$statement = $db->prepare( $selectQuery );

		$statement->execute();

		$bieren = array();

		while ($row = $statement->fetch( PDO::FETCH_ASSOC )) {
			$bieren[] = $row;
		}
		// var_dump($bieren);

		$kolomNamen = array();
		$NieuweKolomNamen = array();

		foreach ($bieren[0] as $key => $value) {
			$kolomNamen[] = $key;

			switch ($key) {
				case 'biernr':
					$kolomNaam = "Biernummer";
					break;
				case 'naam':
					$kolomNaam = "Bier";
					break;
				case 'brnaam':
					$kolomNaam = "Brouwer";
					break;
				case 'soort':
					$kolomNaam = "Soort";
					break;
				case 'alcohol':
					$kolomNaam = "Alcoholpercentage";
					break;
				default:
					$kolomNaam = $key;
					break;
			}
			$NieuweKolomNamen[] = $kolomNaam;

		}
		// var_dump($kolomNamen);
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
	<title>Oplossing CRUD query order by</title>
	<style>

		form ul {
			position: relative;
			left: -40px;
		}

		form ul li {
			list-style: none;
		}

		form ul li input {
			display: block;
		}
		table {
			border-collapse: collapse;
		}

		tr:nth-child(odd) {
			background-color: #f1f1f1;
		}

		th, td {
			border: 1px solid #D3D3D3;
			padding: 3px;
		}

		tr.delete-row {
			background-color: #F2DEDE;
		}

		.delete-confirm {
			margin-bottom: 10px;
			background-color: #F2DEDE;
			border: 1px solid #EED3D7;
		}
		.delete-confirm p {
			margin: 0;
		}		

		.button {
			background-color: transparent;
			border: none;
			padding: 0;
			cursor: pointer;
		}

		.ascending a
		{
			padding-right: 20px;
			background:	no-repeat url('icon-asc.png') right ;
		}

		.descending a
		{
			padding-right: 20px;
			background:	no-repeat url('icon-desc.png') right;
		}

	</style>
</head>
<body>

	<h1>Overzicht van de bieren</h1>

	<table>
		<thead>
			<?php foreach ($NieuweKolomNamen as $key => $kolomNaam): ?>
				<th class="<?= ( $orderKolom == $kolomNamen[$key] ) ? ( ($order == 'ASC') ? 'ascending' : 'descending' ) : '' ?>"><a href="<?= $_SERVER[ 'PHP_SELF' ] ?>?orderBy=<?= $kolomNamen[$key] ?>-<?= $order ?>" ><?php echo $kolomNaam ?></a></th>
			<?php endforeach ?>
			<th></th>	<!-- lege kolomnamen voor delete en edit icon -->
			<th></th>
		</thead>

		<tbody>
 			<?php foreach ($bieren as $key => $bier): ?>
 				<tr>		<!-- class="... ($key + 1) % 2 == 0 ? 'even' : '' ?>" -->
 					<?php foreach ($bier as $value): ?>
 						<td> <?php echo $value ?></td>
 					<?php endforeach ?>
 					<td>
							<button class="button" type="submit" name="delete" value="">
								<img src="icon-delete.png" alt="delete icon">
							</button>
						</td>
						<td>
							<button class="button" type="submit" name="edit" value="">
								<img src="icon-edit.png" alt="edit icon">
							</button>
						</td>
 				</tr>
 			<?php endforeach ?>
 		</tbody>
	</table>
	

</body>
</html>