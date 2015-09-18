<?php

	if (!isset($_SESSION)) session_start();

	$db = new PDO('mysql:host=localhost;dbname=korfball_game', 'root', 'password');

	$name = $score = $country = $errorMessage = $info = $isOldUser = false;

	if (isset($_GET['name']) && 
		isset($_GET['score']) &&
		isset($_GET['country'])) {

		$name = $_GET['name'];
		$score = $_GET['score'];
		$country = $_GET['country'];

		// var_dump($name, $score, $country);
	}

	try {
		$authentication = hash('sha512', session_id());

		$query = 'SELECT * 	FROM highscores
							WHERE authentication = :authentication';

		$statement = $db->prepare($query);
		$statement->bindParam(':authentication', $authentication);
		$statement->execute();

		$scores = array();
		while($row = $statement->fetch(PDO::FETCH_ASSOC)) $scores[] = $row;

		if (!empty($scores)) $isOldUser = true;

		if ($isOldUser) {

			//Time to last update
			$timePassed = strtotime(date("Y-m-d H:i:s")) - strtotime($scores['0']['updated_on']);
			$newScoreIsHigher = $score > $scores[0]['score'];

			if ($timePassed >= 5 && $newScoreIsHigher) {

				$updateQuery =	'UPDATE highscores
							SET	name = :name,
								score = :score,
								country = :country,
								updated_on = NOW()
							WHERE authentication = :authentication';
			
				$updateStatement = $db->prepare($updateQuery);
				$updateStatement->bindParam(':name', $name);
				$updateStatement->bindParam(':score', $score);
				$updateStatement->bindParam(':country', $country);
				$updateStatement->bindParam(':authentication', $authentication);
				$updated = $updateStatement->execute();



				 $info = ($updated) ? 
				 		 'Updated ' . $name . "'s score, new score is: " . $score : 
				 		 'Oeps… your score was not updated… Play again!';
			} else
				$info = (!$newScoreIsHigher) ? 
						'Score: ' . $score . " was not higher then previous attemt!" : 
						"That's a little fast don't you think… your score was not updated!";
		} else {

			$insertQuery =	'INSERT INTO highscores(name, score, added_on, updated_on, authentication, country)
							VALUES(:name, :score, NOW(), NOW(), :authentication, :country)';
			
			$insertStatement = $db->prepare($insertQuery);
			$insertStatement->bindParam(':name', $name);
			$insertStatement->bindParam(':score', $score);
			$insertStatement->bindParam(':country', $country);
			$insertStatement->bindParam(':authentication', $authentication);
			$inserted = $insertStatement->execute();

			$info = ($inserted) ? "Your score is added" : "Oeps… your score was not added… Play again!";
		}
	} catch (PDOException $e) {
		$errorMessage = $e->getMessage();
	}

	echo $info;

?>