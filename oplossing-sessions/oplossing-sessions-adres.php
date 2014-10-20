<?php 
	session_start();

	//plaats alles van registratieinformatie van deel 1 in array $_SESSION
	if ( isset($_POST["submit"]) )
	{
		$_SESSION["registratie"]["e-mail"] = $_POST["e-mail"];
		$_SESSION["registratie"]["nickname"] = $_POST["nickname"];
	}
	
	var_dump($_SESSION);

	$straat = ( isset($_SESSION["registratie"]["straat"]) ? $_SESSION["registratie"]["straat"] : "" );
	$nummer = ( isset($_SESSION["registratie"]["nummer"]) ? $_SESSION["registratie"]["nummer"] : "" );
	$gemeente = ( isset($_SESSION["registratie"]["gemeente"]) ? $_SESSION["registratie"]["gemeente"] : "" );
	$postcode = ( isset($_SESSION["registratie"]["postcode"]) ? $_SESSION["registratie"]["postcode"] : "" );


	if ( isset($_POST["delete-session"]) ) 
	{
		session_destroy();
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sessions: Adres</title>
	<style>
		form li {
			list-style: none;
			margin-left: -40px;
		}
		
		form input {
			display: block;
			margin-bottom: 10px;
			width: 200px;
		}
		form input.button {
			width: 130px;
		}

	</style>
</head>
<body>
	<h1>Registratiegegevens</h1>
	<ul>
		<li>e-mail: <?= $_SESSION["registratie"]["e-mail"] ?></li>
		<li>nickname: <?= $_SESSION["registratie"]["nickname"] ?></li>
	</ul>

	<h1>Deel 2: adres</h1>

	<form action="oplossing-sessions-overzicht.php" method="post">	
		<ul>
			<li>
				<label for="straat">straat</label>
				<input type="text" name="straat" id="straat" value="<?= $straat ?>" <?= ( isset($_GET["focus"]) && $_GET["focus"] == "straat") ? "autofocus" : "" ?> >
			</li>
			<li>
				<label for="nummer">nummer</label>
				<input type="number" name="nummer" id="nummer" value="<?= $nummer ?>" <?= ( isset($_GET["focus"]) && $_GET["focus"] == "nummer") ? "autofocus" : "" ?> >
			</li>
			<li>
				<label for="gemeente">gemeente</label>
				<input type="text" name="gemeente" id="gemeente" value="<?= $gemeente ?>" <?= ( isset($_GET["focus"]) && $_GET["focus"] == "gemeente") ? "autofocus" : "" ?> >
			</li>
			<li>
				<label for="postcode">postcode</label>
				<input type="text" name="postcode" id="postcode" value="<?= $postcode ?>" <?= ( isset($_GET["focus"]) && $_GET["focus"] == "postcode") ? "autofocus" : "" ?>>
			</li>
			<li>
				<input class="button" type="submit" name="submit" value="Volgende">
			</li>
		</ul>
	</form>
	
	<form action="oplossing-sessions-adres.php" method="post">
		<input class="button" type="submit" name="delete-session" value="Delete session">
	</form>


</body>
</html>