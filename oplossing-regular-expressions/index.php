<?php 

	$resultaat = '';
	$message = '';

	if ( isset( $_POST[ 'submit' ]) ) {
		$regEx = $_POST[ 'regex' ];
		$string = $_POST[ 'string' ];

		$matchGevonden = preg_match_all( "/" . $regEx . "/", $string, $matchArray );

		if ( $matchGevonden ) {
			$resultaat = preg_replace( "/" . $regEx . "/", "<span>#</span>", $string );
		}
		else {
			$message = "Er ging iets mis.";
		}
		
	}


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing regular expressions</title>
	<style>

		form ul {
			position: relative;
			left: -40px;
		}

		form ul li {
			list-style: none;
		}
	
		form ul li label {
			display: block;
		}

		span {
			color: red;
		}

	</style>
</head>
<body>
	
	<h1>RegEx Tester</h1>

	<p><?= $message ?></p>

	<form action="index.php" method="POST">
		<ul>
			<li>
				<label for="regex">Regular Expression</label>
				<input type="text" name="regex" value="<?= $regEx ?>">
			</li>
			<li>
				<label for="string">String</label>
				<textarea name="string" id="string" cols="30" rows="10"><?= $string ?></textarea>
			</li>
			<input type="submit" name="submit" value="Pas regular expression toe">
		</ul>
	</form>

	<p><?= $resultaat ?></p>

	<p>
		<?php foreach ( $matchArray[0] as $key => $match): ?>
			<?= $match ?> _ 
		<?php endforeach ?>
	</p>

	<h3>1ste RegEx</h3>
	<ul>
		<li>Regular Expression: /[a-du-zA-DU-Z]/</li>
		<li>String: Memory can change the shape of a room; it can change the color of a car. And memories can be distorted. They're just an interpretation, they're not a record, and they're irrelevant if you have the facts.</li>
		<li>Matches (gescheiden door -): y - c - a - c - a - a - a - c - a - c - a - c - a - c - a - A - d - c - a - b - d - d - y - u - a - a - y - a - c - d - a - d - y - v - a - y - u - a - v - a - c</li>
	</ul>

	<h3>2de RegEx</h3>
	<ul>
		<li>Regular Expression: /colou?r/</li>
		<li>String: Zowel colour als color zijn correct Engels.</li>
		<li>Matches (gescheiden door -): colour - color </li>
	</ul>

	<h3>3de RegEx</h3>
	<ul>
		<li>Regular Expression: /1\d{3}/</li>
		<li>String: 1020 1050 9784 1560 0231 1546 8745</li>
		<li>Matches (gescheiden door -): 1020 - 1050 - 1560 - 1546 </li>
	</ul>

	<h3>4de RegEx</h3>
	<ul>
		<li>Regular Expression: /[^en]/</li>
		<li>String: 24/07/1978 en 24-07-1978 en 24.07.1978</li>
		<li>Matches (gescheiden door _): 2 _ 4 _ / _ 0 _ 7 _ / _ 1 _ 9 _ 7 _ 8 _ _ _ 2 _ 4 _ - _ 0 _ 7 _ - _ 1 _ 9 _ 7 _ 8 _ _ _ 2 _ 4 _ . _ 0 _ 7 _ . _ 1 _ 9 _ 7 _ 8</li>
	</ul>

</body>
</html>