<?php 

	$message = "";
	
	if (isset($_POST["submit"])) {
		try 
		{
			
			$db = new PDO("mysql:host=localhost;dbname=bieren", "root", "root");

			$queryString = "INSERT INTO brouwers (brnaam, adres, postcode, gemeente, omzet)
												VALUES (:brnaam, :adres, :postcode, :gemeente, :omzet)";

			$statement = $db->prepare( $queryString );

			$statement->bindParam(":brnaam", 		$_POST["brouwernaam"]);
			$statement->bindParam(":adres", 		$_POST["adres"]);
			$statement->bindParam(":postcode", 	$_POST["postcode"]);
			$statement->bindParam(":gemeente", 	$_POST["gemeente"]);
			$statement->bindParam(":omzet", 		$_POST["omzet"]);

			$brouwerToegevoegd = $statement->execute();

			if ($brouwerToegevoegd) {
				$primaryKeyBrouwer = $db->lastInsertId();
				$message = "Brouwerij succesvol toegevoegd. Het unieke nummer van deze brouwerij is " . $primaryKeyBrouwer;
			}
			else {
				$message = "Er ging iets mis met het toevoegen. Probeer opnieuw.";
			}

		} 
		catch (Exception $e) 
		{
			$message = "Er ging iets mis: " . $e->getMessage();
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing CRUD insert</title>
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
	</style>
</head>
<body>
	<h1>Voeg een brouwer toe</h1>
 	<p><?php echo $message ?></p>

	<form action="oplossing-crud-insert.php" method="POST">
		<ul>
			<li>
				<label for="broiwernaam">Brouwernaam:</label>
				<input type="text" name="brouwernaam" id="brouwernaam">
			</li>
			<li>
				<label for="adres">Adres:</label>
				<input type="text" name="adres" id="adres">
			</li>
			<li>
				<label for="postcode">Postcode:</label>
				<input type="text" name="postcode" id="postcode">
			</li>
			<li>
				<label for="gemeente">Gemeente:</label>
				<input type="text" name="gemeente" id="gemeente">
			</li>
			<li>
				<label for="omzet">Omzet:</label>
				<input type="text" name="omzet" id="omzet">
			</li>
		</ul>
		<input type="submit" value="Query verzenden" name="submit">
	</form>
</body>
</html>