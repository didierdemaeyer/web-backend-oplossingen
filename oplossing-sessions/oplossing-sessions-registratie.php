<?php 
	//Registratiepagina
	session_start();

	$email = ( isset($_SESSION["registratie"]["e-mail"]) ? $_SESSION["registratie"]["e-mail"] : "" );
	$nickname = ( isset($_SESSION["registratie"]["nickname"]) ? $_SESSION["registratie"]["nickname"] : "" );

	if ( isset($_POST["delete-session"]) ) 
	{
		session_destroy();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sessions: Registratie</title>
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
			width: 100px;
		}

	</style>
</head>
<body>
	<h1>Deel 1: registratiegegevens</h1>
	<form action="oplossing-sessions-adres.php" method="post">
		<ul>
			<li>
				<label for="e-mail">e-mail</label>
				<input type="text" name="e-mail" id="e-mail" value"<?= $email ?>" <?= ( isset($_GET["focus"]) && $_GET["focus"] == "e-mail") ? "autofocus" : "" ?>>
			</li>
			<li>
				<label for="nickname">nickname</label>
				<input type="text" name="nickname" id="nickname" value="<?= $nickname ?>" <?= ( isset($_GET["focus"]) && $_GET["focus"] == "nickname") ? "autofocus" : "" ?>>
			</li>
		</ul>
		<input class="button" type="submit" name="submit" value="Volgende">
	</form>

	<form action="oplossing-sessions-registratie.php" method="post">
		<input class="button" type="submit" name="delete-session" value="Delete session">
	</form>
</body>
</html>