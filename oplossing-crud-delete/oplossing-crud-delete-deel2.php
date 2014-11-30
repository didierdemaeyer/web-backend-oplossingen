<?php 
	
	$deleteConfirm = false;
	$deleteId = false;

	if (isset($_GET["message"])) {
		$message = $_GET["message"];
	}
	else {
		$message = "";
	}

	try 
	{
		
		$db = new PDO("mysql:host=localhost;dbname=bieren", "root", "root");

		$queryString = "SELECT * 
											FROM brouwers";

		$statement = $db->prepare($queryString);

		$statement->execute();

		$brouwers = array();

		while ($row = $statement->fetch( PDO::FETCH_ASSOC )) {
			$brouwers[] = $row;
		}
		//var_dump($bieren);

		$kolomNamen = array();
		$kolomNamen[] = "#";

		foreach ($brouwers[0] as $key => $value) {
			$kolomNamen[] = $key;
		}

		$kolomNamen[] = "";


		/***********************************
		** =DELETE
		***********************************/

		if (isset($_POST["delete"])) {
			$deleteConfirm = true;
			$deleteId = $_POST["delete"];
		}

		if (isset($_POST["confirm"])) {
			
			$deleteQuery = "DELETE FROM brouwers
												WHERE brouwernr = :brouwernr";

			$deleteStatement = $db->prepare($deleteQuery);

			$deleteStatement->bindParam(":brouwernr", $_POST["confirm"]);

			$brouwerVerwijderd = $deleteStatement->execute();

			if ($brouwerVerwijderd) {
				$message = "De datarij werd goed verwijderd.";

				header("location:oplossing-crud-delete-deel2.php?message=$message");				
			}
			else {
				$message = "De datarij kon niet verwijderd worden. Probeer opnieuw.";
			}
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
	<title>Oplossing CRUD delete</title>
	<style>
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

		.button-delete {
			background-color: transparent;
			border: none;
			padding: 0;
			cursor: pointer;
		}

	</style>
</head>
<body>
	<h1>Overzicht van brouwers</h1>
	<p><?php echo $message ?></p>
	
	<?php if ($deleteConfirm): ?>
		<div class="delete-confirm">
			<p>Bent u zeker dat u deze datarij wil verwijderen?</p>
			<form action="oplossing-crud-delete-deel2.php" method="POST">
				<button type="submit" name="confirm" value="<?php echo $deleteId ?>">Ja!</button>
				<button type="submit">Nee!</button>
			</form>
		</div>
	<?php endif ?>

	<form action="oplossing-crud-delete-deel2.php" method="POST">
		<table>
	 		<thead>
	 			<tr>
	 				<?php foreach ($kolomNamen as $key): ?>
	 					<th><?php echo $key ?></th>
	 				<?php endforeach ?>
	 			</tr>
	 		</thead>

	 		<tbody>
	 			<?php foreach ($brouwers as $key => $brouwer): ?>
	 				<tr class="<?= ( $brouwer['brouwernr'] === $deleteId ) ? 'delete-row' : ''  ?>">		<!-- class="... ($key + 1) % 2 == 0 ? 'even' : '' ?>" -->
	 					<td><?php echo ($key + 1) ?></td>
	 					<?php foreach ($brouwer as $value): ?>
	 						<td><?php echo $value ?></td>
	 					<?php endforeach ?>
	 					<td>
							<button class="button-delete" type="submit" name="delete" value="<?php echo $brouwer[ 'brouwernr' ] ?>">
								<img src="icon-delete.png" alt="delete icon">
							</button>
						</td>
	 				</tr>
	 			<?php endforeach ?>
	 		</tbody>
	 	</table>
	</form>
</body>
</html>