<?php 

	/**
	* 
	*/
	class RegisterController extends BaseController
	{
		
		public function getRegister()
		{
			return View::make('register');
		}

		public function postRegister()
		{
			$rules = array(
					'email' => 'required|email|unique:users',
					'password' => 'required|min:8'
				);
			$messages = array(
					'email.required' => 'Je moet een e-mailadres ingeven.',
					'email.email' => 'Het ingegeven e-mailadres is niet geldig.',
					'email.unique' => 'Er ging iets mis met het e-mailadres. Probeer opnieuw',
					'password.required' => 'Je moet een paswoord ingeven.',
					'password.min' => 'Het paswoord moet minstens 8 karakters lang zijn'
				);
			$validator = Validator::make( Input::all(), $rules, $messages );

			if ( $validator->fails() ) {
				return Redirect::to('register')->withErrors( $validator );
			}


			/* Originele manier waarop ik gevalideerd had -> teveel validators? */

			// /* Validator: Inputvelden mogen niet leeg zijn */
			// $inputRules = array( 'email' => 'required', 'password' => 'required' );
			// $inputValidator = Validator::make( Input::all(), $inputRules );

			// if ( $inputValidator->fails() ) {
			// 	return Redirect::to('register')->withErrors( array( 
			// 			'Oeps, je moet een e-mailadres en paswoord ingeven. Probeer opnieuw'
			// 	 	));
			// }

			// /* Validator: Het e-mailadres moet geldig zijn en mag nog niet in de databank users zitten */
			// $emailRules = array( 'email' => 'email|unique:users' );
			// $emailValidator = Validator::make( Input::all(), $emailRules );

			// if ( $emailValidator->fails() ) {
			// 	return Redirect::to('register')->withErrors( array( 
			// 			'Het ingegeven e-emailadres is niet geldig. Probeer opnieuw'
			// 		));
			// }

			// /* Validator: Het paswoord moet minstens bestaan uit 8 karakters */
			// $passwordRules = array( 'password' => 'min:8' );
			// $passwordValidator = Validator::make( Input::all(), $passwordRules );

			// if ( $passwordValidator->fails() ) {
			// 	return Redirect::to('register')->withErrors( array( 
			// 			'Het ingegeven paswoord is te kort, het paswoord moet minsens 8 karakters lang zijn.'
			// 		));
			// }

			/* Dit was de methode die ik eerst gebruikte om een gebruiker toe te voegen aan de DB, maar toen werd de created_at tabel niet geupdate */
			// $user = array(
			// 		array(
			// 				'email'	=> Input::get('email'),
			// 				'password'	=> Hash::make( Input::get('password') )
			// 			)
			// 	);
			// DB::table('users')->insert( $user );
			

			/* Gebruiker toevoegen aan DB */
			$user = new User;
			$user->email = Input::get('email');
			$user->password = Hash::make( Input::get('password') );
			$user->save();

			/* Auth zodat gebruiker meteen ingelogd wordt en dus niet terug naar register of login pagina kan zonder uit te loggen */ 
			Auth::attempt( array(
					'email' => Input::get('email'),
					'password' => Input::get('password')
				), false	);

			return Redirect::to('dashboard')->with( 'message', 'U bent succesvol geregistreerd.' );
		}

	}

?>