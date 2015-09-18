<?php
	var_dump($_POST);

	$username = false;
	$password = false;

	$userIsValid = false;
	$authentication = false;
	$loggedIn = false;



	$salt1 = "56a"; //Er bestaan php functies die een random salt aanmaken. Hoe meer karakters in salt, hoe veiliger
	$originalPw = "abc";

	$salt2 = 'oepajdi';
	$originalPw2 = "testkdg";

	$saltedPw = $salt1.$originalPw;
	$saltedPw2 = $salt2.$originalPw2;

	echo hash('sha512', 'abc');
	echo "<br>";
	echo hash('sha512', $saltedPw);
	echo "<br>";
	echo hash('sha512', $saltedPw2);


	//Data uit de database
	// $users[] = array('username' => 'info@test.be', 
	// 				'password' => 'abc');
	//Met hash:
	$users[] = array('username' => 'info@test.be', 
					'salt' => '56a', 							//de salt opslaan bij de gebruiker
					'password' => 'ddaf35a193617abacc417349ae20413112e6fa4e89a97ea20a9eeee64b55d39a2192992a274fc1a836ba3c23a3feebbd454d4423643ce80e2a9ac94fa54ca49f');

	// $users[] = array('username' => 'pascal@kdg.be',
	// 				'salt' => 'oepajdi',
	// 				'password' => 'testkdg');
	//Met hash:
	$users[] = array('username' => 'pascal@kdg.be',
					'salt' => 'oepajdi',
					'password' => 'a18575082cbf01eb964107c04d53899fc52ae24ffc4adb12c297c45fd635f0d20f5fe643e287da2913d8571a84c533a0f9c05bb8d186c600fd42b42b30e77091');


	if (isset($_COOKIE['loggedIn']))  //als de gebruiker op de pagina komt: testen adhv de cookie of de gebruiker al ingelogd is
	{
		//$loggedIn = true; //als de cookie geset, is dan is loggedIn true --> niet veilig, je kan via JavaScript zelf een cookie aanmaken met de value loggedIn=true
		
		$hashedUsernameCookie = $_COOKIE['loggedIn'];
		foreach ($users as $user) 
		{
			$hashedUsername = hash('sha512', $user['salt'], $user['username']);
			if () 
			{
			
			}
		}
	}
	else //als de cookie niet geset is, dan moeten we checken of de gebruiker met de ingevulde gegevens ingelogd kan worden of niet
	{
		if ( isset( $_POST['submit'])) 
		{
			$authentication = true;
			$username = $_POST['username'];
			$password = $_POST['password'];
		}

		
		if ($username && $password) 
		{
			//controleren of username voorkomt, en als hij voorkomt dat het paswd ook klopt
			//Nooit zeggen dat het emailadres fout is, of het paswoord. Gewoon error geven: "emailadres en of paswd is incorrect"
			//Als je individueel benoemt wat er mis is, geef je de hacker al de helft informatie --> hacker weet dan dat bv een user wel bestaat, maar dat hij het paswd nog niet heeft
			foreach ($users as $user) 
			{
				//$hashedPassword = hash( 'sha512',$password);	//superveilig: B-cript
				$hashedAndSaltedPassword = hash( 'sha512', $user['salt'], $password);
				
				if ($user['username'] == $username
					&& $user['password'] == $hashedAndSaltedPassword) 
				{
					$salt = $user['salt'];
					$userIsValid = true;
					break; //Anders blijf je de gebruikers overlopen, vanaf de eerste overeenkomstige username & paswd, is de userIsValis=true, en mag je stoppen met nr gebruiker zoeken
				}
			}
		}

		if ($authentication && $userIsValid) 
		{
			$hashedUsername = hash('sha512', $salt.$username);
			$cookieValue = $hashedUsername;

			setcookie();
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
	<?php if ($loggedIn): ?>
		<p>U bent correct ingelogd.</p>
	
	<?php else: ?>
		<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
			<label for="name">Username:</label>
			<br/>
			<input type="text" name="username" id="username" value="info@test.be">
			<br/>
			<label for="password">Paswoord:</label>
			<br/>
			<input type="text" name="password" id="password" value="abc">
			<br/>
			<input type="submit" name="submit" id="submit">
		</form>
	<?php endif ?>
</body>
</html>