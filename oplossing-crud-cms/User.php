<?php 

	/**
	* This class is used to create new users,
	* create a cookie for 30 days when the user has logged in so the user automatically logs in
	* and to validate the user and the cookie
	*/
	class User
	{
		
		public static function createNewUser( $connection, $email, $password )
		{
			$salt = uniqid( mt_rand(), true );

			$hashedPassword = hash( 'sha512', $password . $salt );

			$db = new Database( $connection );

			$queryString = 'INSERT INTO users (email, salt, hashed_password, last_login_time)
												VALUES (:email, :salt, :hashed_password, NOW())';

			$parameters = array( 	':email' 	=> $email,
														':salt' 	=> $salt,
														':hashed_password' => $hashedPassword);

			$userData = $db->query( $queryString, $parameters );

			$cookie = self::createCookie( $salt, $email );

			return $cookie;
		}

		public static function logout()
		{
			$unsetCookie = setcookie('login', '', time() - 99999999);

			return $unsetCookie;
		}

		public static function createCookie( $salt, $email )
		{
			$hashedEmail = hash( 'sha512', $salt . $email );
			$cookieValue = $email . ',' . $hashedEmail;

			/* COOKIE aanmaken geldig voor 30 dagen */
			$cookie = setcookie( 'login', $cookieValue, time() + 2592000);	//2592000 = 30 * 24 * 60 * 60 => 30 dagen
			
			return $cookie;
		}

		public static function validate( $connection )
		{
			if ( isset( $_COOKIE[ 'login' ]) ) {
				
				$userData = explode( ',', $_COOKIE[ 'login' ] );
				$email = $userData[ 0 ];
				$saltedEmail = $userData[ 1 ];

				$db = new Database( $connection );

				$queryString = 'SELECT * 
													FROM users 
													WHERE email = :email';

				$parameters = array( ':email' => $email );

				$userData = $db->query( $queryString, $parameters );

				if ( isset($userData[ 'data' ][ 0 ]) ) {
					$salt = $userData[ 'data' ][ 0 ][ 'salt' ];

					$newlySaltedEmail = hash( 'sha512', $salt. $email );

					if ( $newlySaltedEmail == $saltedEmail ) {
						/* Cookie is correct */
						return true;
					}
					else {
						/* Cookie is niet correct */
						return false;
					}
				}
				else {
					/* User is niet gevonden */
					return false;
				}
			}
			else {
				/* Cookie is niet geset */
				return false;
			}
		}
	}


 ?>