<?php 
	//DEEL 1
	$text = file_get_contents("text-file.txt");
	$textChars = str_split($text, 1);	//str_split($string, $split_length); splitst string op in delen van $split_length en plaatst deze in een array
	rsort($textChars);	//sorteer van Z naar A
	$textCharsReversed = array_reverse($textChars);	//draai array om

	$verschillendeChars = array();
	foreach ($textCharsReversed as $value) {
		if ( isset($verschillendeChars[ $value ]) ) {
			$verschillendeChars[$value]++;
		}
		else {
			$verschillendeChars[$value] = 1;
		}
	}


	//DEEL 2
	$tekst = file_get_contents("text-file.txt");
	$tekst = strtolower($tekst);

	$textChars2 = str_split($tekst, 1);
	sort($textChars2);
	
	$charsAlphabet = array();
	foreach ($textChars2 as $value) {
		if (ctype_alpha( $value )) {
			if ( isset($charsAlphabet[ $value ])) {
				$charsAlphabet[ $value ]++;
			}
			else {
				$charsAlphabet[ $value ] = 1;
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing for</title>
</head>
<body>
	<h1>Deel 1</h1>
	<p>Z => A: <?php //var_dump($textChars) ?></p>
	<p>A => Z: <?php //var_dump($textCharsReversed) ?></p>
	<p>Aantal verschillende karakters: <?= count($verschillendeChars) ?></p>
	<p>Aantal keer eenzelfde karakter voorkomt: <?php //var_dump($verschillendeChars) ?></p>

	<h1>Deel 2</h1>
	<p><?php var_dump($charsAlphabet) ?></p>
</body>
</html>