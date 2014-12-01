<?php 

	if (isset($_GET["message"])) {
		$message = $_GET["message"];
	}
	else {
		$message = null;
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
		// var_dump($brouwers);

		$kolomNamen = array();
		$kolomNamen[] = "#";

		foreach ($brouwers[0] as $key => $value) {
			$kolomNamen[] = $key;
		}

		$kolomNamen[] = "";
		$kolomNamen[] = "";


		/***********************************
		** =DELETE
		***********************************/

		$deleteConfirm = false;
		$deleteId = false;

		if (isset($_POST["delete"])) {
			$deleteConfirm = true;
			$deleteId = $_POST["delete"];
		}

		if (isset($_POST["confirm-delete"])) {
			
			$deleteQuery = "DELETE FROM brouwers
												WHERE brouwernr = :brouwernr";

			$deleteStatement = $db->prepare($deleteQuery);

			$deleteStatement->bindParam(":brouwernr", $_POST["confirm-delete"]);

			$brouwerVerwijderd = $deleteStatement->execute();

			if ($brouwerVerwijderd) {
				$message = "De datarij werd goed verwijderd.";

				header("location:oplossing-crud-update-deel1.php?message=$message");				
			}
			else {
				$message = "De datarij kon niet verwijderd worden. Probeer opnieuw.";
			}
		}


		/***********************************
		** =UPDATE
		***********************************/

		$brouwerNaam = null;
		$brouwerNummer = null;
		$editConfirm = false;
		$currentBrouwer = null;

		if (isset($_POST["edit"])) {
			foreach ($brouwers as $key => $brouwer) {
				if ($brouwer["brouwernr"] == $_POST["edit"]) {
					$editConfirm = true;
					$brouwerNaam = $brouwer["brnaam"];
					$brouwerNummer = $_POST["edit"];
					$currentBrouwer = $brouwer;
					var_dump($currentBrouwer);
				}
			}
			if ($brouwerNaam == null && $brouwerNummer == null) {
				$message = "Deze brouwerij werd niet gevonden.";
			}
		}

		if (isset($_POST["confirm-edit"])) {
			
			$updateQuery	=	'UPDATE brouwers
												SET brnaam 		= :brnaam,
														adres			=	:adres,
														postcode 	=	:postcode,
														gemeente 	=	:gemeente,
														omzet			=	:omzet
												WHERE brouwernr	= :brouwernr
												LIMIT 1';

			$updateStatement = $db->prepare( $updateQuery );

			$updateStatement->bindParam(":brnaam", 		$_POST["brnaam"]);
			$updateStatement->bindParam(":adres", 		$_POST["adres"]);
			$updateStatement->bindParam(":postcode", 	$_POST["postcode"]);
			$updateStatement->bindParam(":gemeente", 	$_POST["gemeente"]);
			$updateStatement->bindParam(":omzet", 		$_POST["omzet"]);
			$updateStatement->bindParam(":brouwernr", $_POST["brouwernr"]);

			$brouwerUpdated = $updateStatement->execute();

			if ($brouwerUpdated) {
				$message = "Aanpassing succesvol doorgevoerd.";
			}
			else {
				$message = "Aanpassing is niet gelukt. Probeer opnieuw of neem contact op met de systeembeheerder wanneer deze fout blijft aanhouden. <a href='mailto:systeembeheerder@hotmail.com>Systeembeheerder</a>";
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
	<title>Oplossing CRUD update</title>
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

	</style>
</head>
<body>
	
	<?php if ( $brouwerNaam != null && $brouwerNummer != null): ?>
			<h1>Brouwerij <?php echo $brouwerNaam ?> (#<?php echo $brouwerNummer ?>) Wijzigen</h1>		
	<?php endif ?>	

	<p><?php echo $message ?></p>
	
	<?php if ( $editConfirm ): ?>
		<div>
			<form action="oplossing-crud-update-deel1.php" method="POST">
				<ul>
					<?php foreach ($currentBrouwer as $fieldname => $value): ?>
						
						<?php if ( $fieldname != "brouwernr" ): ?>
							<li>
								<label for="<?= $fieldname ?>"><?= $fieldname ?></label>
								<input type="text" id="<?= $fieldname ?>" name="<?= $fieldname ?>" value="<?= $value ?>">
							</li>
						<?php endif ?>
						
					<?php endforeach ?>
				</ul>
				<input type="hidden" value="<?= $brouwerNummer ?>" name="brouwernr">
				<input type="submit" name="confirm-edit" value="Query Verzenden">
			</form>
		</div>
	<?php endif ?>	

	<?php if ($deleteConfirm): ?>
		<div class="delete-confirm">
			<p>Bent u zeker dat u deze datarij wil verwijderen?</p>
			<form action="oplossing-crud-update-deel1.php" method="POST">
				<button type="submit" name="confirm-delete" value="<?php echo $deleteId ?>">Ja!</button>
				<button type="submit">Nee!</button>
			</form>
		</div>
	<?php endif ?>

	<h1>Overzicht van brouwers</h1>

	<form action="oplossing-crud-update-deel1.php" method="POST">
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
							<button class="button" type="submit" name="delete" value="<?php echo $brouwer[ 'brouwernr' ] ?>">
								<img src="icon-delete.png" alt="delete icon">
							</button>
						</td>
						<td>
							<button class="button" type="submit" name="edit" value="<?php echo $brouwer[ 'brouwernr' ] ?>">
								<img src="icon-edit.png" alt="edit icon">
							</button>
						</td>
	 				</tr>
	 			<?php endforeach ?>
	 		</tbody>
	 	</table>
	</form>
</body>
</html>