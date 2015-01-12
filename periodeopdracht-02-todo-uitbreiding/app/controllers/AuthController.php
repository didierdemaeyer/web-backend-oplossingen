<?php 

	/**
	* 
	*/
	class AuthController extends BaseController
	{
		
		public function getLogin()
		{
			return View::make('login');
		}

		public function postLogin()
		{
			$rules = array( 'email' => 'required', 'password' => 'required' );
			$validator = Validator::make( Input::all(), $rules );

			if ( $validator->fails() ) {
				return Redirect::to('login')->withErrors( array( 
						'Oeps, je moet een e-mailadres en paswoord ingeven. Probeer opnieuw',
					));
			}

			$auth = Auth::attempt( array(
					'email' => Input::get('email'),
					'password' => Input::get('password')
				), false	);	/* waar nu false staat kan gebruikt worden voor een remember me ... */

			if ( !$auth ) {
				return Redirect::to('login')->withErrors( array( 
						'Oeps, je e-mailadres en/of paswoord waren niet juist. Probeer opnieuw'
					));
			}

			return Redirect::to('dashboard')->with( 'message', 'U bent succesvol ingelogd. Welkom' );
			
		}

		public function logout()
		{
			Auth::logout();

			return Redirect::to('/')->with( 'message', 'U bent succesvol uitgelogd. Tot de volgende keer' );
		}
	}

?>