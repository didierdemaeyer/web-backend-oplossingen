<?php
	if (!isset($_SESSION)) session_start();
	
	$scores = $underlying = $abovelying = false;

	$db = new PDO('mysql:host=localhost;dbname=korfball_game', 'root', 'password');

	$authentication = hash('sha512', session_id());

	$returnObject = false;

	if ($authentication) {

		if (isset($_GET['abovelying']) || isset($_GET['underlying'])) {
			$quantity = intval($_GET['abovelying']);
			if ($quantity > 20) $quantity = 20;

			$query = 	'SELECT name, score, country
						FROM highscores
						WHERE authentication = :authentication';

			$statement = $db->prepare($query);
			$statement->bindParam(':authentication', $authentication);
			$statement->execute();

			$scores = array();

			while($row = $statement->fetch(PDO::FETCH_ASSOC)) $scores[] = $row;

			$returnObject['me'] = $scores;

		}

		if (isset($_GET['abovelying'])) {

			$quantity = intval($_GET['abovelying']);
			if ($quantity > 20) $quantity = 20;

			$query = 	'SELECT name, score, country
						FROM highscores
						WHERE score > 
							(SELECT score 
							FROM highscores
							WHERE authentication = :authentication) 
						ORDER BY score ASC, updated_on ASC
						LIMIT :top';

			$statement = $db->prepare($query);
			$statement->bindValue(':top', $quantity, PDO::PARAM_INT);
			$statement->bindParam(':authentication', $authentication);
			$statement->execute();

			$scores = array();

			while($row = $statement->fetch(PDO::FETCH_ASSOC)) $scores[] = $row;

			$returnObject['abovelying'] = $scores;

		}

		if (isset($_GET['underlying'])) {

			$quantity = intval($_GET['underlying']);
			if ($quantity > 20) $quantity = 20;

			$query = 	'SELECT name, score, country
						FROM highscores
						WHERE score < 
							(SELECT score 
							FROM highscores
							WHERE authentication = :authentication) 
						ORDER BY score DESC, updated_on ASC
						LIMIT :top';

			$statement = $db->prepare($query);
			$statement->bindValue(':top', $quantity, PDO::PARAM_INT);
			$statement->bindParam(':authentication', $authentication);
			$statement->execute();

			$scores = array();

			while($row = $statement->fetch(PDO::FETCH_ASSOC)) $scores[] = $row;

			$returnObject['underlying'] = $scores;

		}
	}

	if (isset($_GET['top'])){
		$quantity = intval($_GET['top']);
		if ($quantity > 50) $quantity = 50;

		$query = 	'SELECT name, score, country 
				 	FROM highscores
					ORDER BY score DESC, updated_on ASC
					LIMIT :top';

		$statement = $db->prepare($query);
		$statement->bindValue(':top', $quantity, PDO::PARAM_INT);
		$statement->execute();

		$scores = array();

		while($row = $statement->fetch(PDO::FETCH_ASSOC)) $scores[] = $row;

		$returnObject['top'] = $scores;
	}


	echo json_encode($returnObject);

?>