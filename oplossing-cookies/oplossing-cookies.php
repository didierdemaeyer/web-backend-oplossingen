<?php 
	setcookie("loginCookie","", time()+360);

	$textfile = file_get_contents("test.txt");	//neemt de inhoud van een bestand en plaatst dit in een string

	$accountArray = explode(",", $textfile);	//plaats inhoud van een string in een array, met "," als scheiding
	
	$gebruikersnaam;
	$paswoord;

	if ( isset($_POST["submit"]) ) {
		

		$_COOKIE["gebruikersnaam"] 	= $_POST["gebruikersnaam"];
		$_COOKIE["paswoord"] 				= $_POST["paswoord"];

		$gebruikersnaam = $_POST["gebruikersnaam"];
		$paswoord 			= $_POST["paswoord"];
	}
	
	if ( isset($_GET["delete-cookie"]) ) {
		setcookie("loginCookie", "", time()-3600);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing Cookies</title>
	<style>
		li {
			list-style: none;
			margin-bottom: 10px;
		}

		label {
			display: block;
		}

		.fout {
			padding: 5px;

			color: #B94A48;
			background-color: #F2DEDE;
			border: 1px solid #EED3D7;
			border-radius: 5px;
		}
	</style>
</head>
<body>
	<h1>Inloggen</h1>
	<?php if ( isset($gebruikersnaam) && isset($paswoord) ): ?>

		<?php if ( $gebruikersnaam == $accountArray[0] && $paswoord == $accountArray[1] ): ?>
			
			<p>U bent ingelogd</p>
			<a href="oplossing-cookies.php?delete-get=true">Uitloggen</a>

		<?php else: ?>

			<p class="fout">Gebruikersnaam en/of paswoord niet correct. Probeer opnieuw</p>
			<form action="oplossing-cookies.php" method="post">
				<ul>
					<li>
						<label for="gebruikersnaam">gebruikersnaam</label>
						<input type="text" name="gebruikersnaam" id="gebruikersnaam">
					</li>
					<li>
						<label for="paswoord">paswoord</label>
						<input type="password" name="paswoord" id="paswoord">
					</li>
					<li>
						<input type="submit" name="submit" value="Query verzenden">
					</li>
				</ul>
			</form>

		<?php endif ?>

	<?php else: ?>

		<form action="oplossing-cookies.php" method="post">
			<ul>
				<li>
					<label for="gebruikersnaam">gebruikersnaam</label>
					<input type="text" name="gebruikersnaam" id="gebruikersnaam">
				</li>
				<li>
					<label for="paswoord">paswoord</label>
					<input type="password" name="paswoord" id="paswoord">
				</li>
				<li>
					<input type="submit" name="submit" value="Query verzenden">
				</li>
			</ul>
		</form>

	<?php endif ?>

	

</body>
</html>