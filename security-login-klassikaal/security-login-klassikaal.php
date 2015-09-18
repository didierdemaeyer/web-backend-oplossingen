<?php

	
	var_dump( $_POST );
	
	$username	=	false;
	$password	=	false;
	$salt		=	false;

	$authentication	=	false;
	$userIsValid	=	false;

	$loggedIn	=	false;

	// Data uit de database
	$users[]	=	array( 'username' => 'info@test.be',
							'salt'		=> '56a',
							'password' => '95df3d1cc1f45f250ce23bed4dfe3e35997c959f3226a1beec088a0d9dac945607eb15388708a79460b9331701d5fa319f0aec39991d9fafc20a61238d876f3f');

	$users[]	=	array( 'username' => 'pascal@kdg.be',
							'salt'	=>	'dfiogiosdoepep', 
							'password' => '15b0e56b50c5f93359c09cb7f675c75ee59be764ae3c5927794b3fb01ed896bc2e0fe675b2c09e9b0b8bff96d1d7b664261c7bbbba6dec1cd25e5b7a2badd55c');


	if ( isset( $_COOKIE['loggedIn'] ) )
	{
		

		$cookieData	=	explode(  '##', $_COOKIE[ 'loggedIn' ] );
		var_dump( $cookieData );
		$usernameCookie	=	$cookieData[ 0 ];
		$hashedUsernameCookie	=	$cookieData[ 1 ];

		foreach( $users as $user )
		{
			if ( $user[ 'username' ] == $cookieData[ 0 ] )
			{
				$hashedUsername	=	hash( 'sha512', $user[ 'salt' ] . $user[ 'username' ] );
			
				if ( $hashedUsername == $hashedUsernameCookie )
				{
					$loggedIn	=	true;
				}
				break;
			}
			
		}
	}
	else
	{
		/*$salt 	=	"56a";
		$originalPw	=	"abc";

		$saltedPw	=	$salt . $originalPw;

		echo hash( 'sha512', $saltedPw );*/

		if ( isset( $_POST[ 'submit' ] ) )
		{
			$authentication	=	true;

			$username	=	$_POST[ 'username' ];
			$password	=	$_POST[ 'password' ];
		}

		if( $username && $password )
		{
			foreach( $users as $user )
			{

				$hashedAndSaltedPassword	=	hash( 'sha512', $user['salt'] . $password );

				if ( $user[ 'username' ] == $username &&
						$user[ 'password' ] == $hashedAndSaltedPassword )
				{
					$salt			=	$user[ 'salt' ]; 
					$userIsValid	=	true;
					break;
				}
			}
		}

		if ( $authentication && $userIsValid )
		{
			$hashedUsername	=	hash( 'sha512', $salt . $username );
			$cookieValue	=	$username . '##' . $hashedUsername;

			setcookie( 'loggedIn', $cookieValue, time() + 60 );
			header( 'location: ' . $_SERVER['PHP_SELF'] );
		}
	}

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php ( !$individueelArtikel ) ? 'overzicht' : $artikels[$individueelArtikel]['titel'] ?></title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>

    <?php if ( $loggedIn): ?>

    	<p>"U bent correct ingelogd"</p>
    
	<?php else: ?>

		<?php if ( $authentication ): ?>

		<?=  ( $userIsValid ) ? "" : "Username & password niet geldig" ?>

		<?php endif ?>
	    
    	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

    		<input type="text" name="username" value="info@test.be">

    		<input type="text" name="password" value="abc">

    		<input type="submit" name="submit">

    	</form>

    <?php endif ?>

	

        <script src="js/main.js"></script>
    </body>
</html>