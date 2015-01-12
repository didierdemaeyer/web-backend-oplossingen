<?php 

	/**
	* 
	*/
	class UsersTableSeeder extends Seeder
	{
		
		public function run()
		{
			DB::table('users')->delete();

			$users = array(
					array(
							'email'	=> 'didier@test.be',
							'password'	=> Hash::make('didier')
						)
				);

			DB::table('users')->insert( $users );
		}
	}

?>