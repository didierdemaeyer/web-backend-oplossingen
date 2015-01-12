<?php 

	/**
	* 
	*/
	class ItemsTableSeeder extends Seeder
	{
		
		public function run()
		{
			DB::table('items')->delete();

			$items = array(
					array(
							'owner_id'	=> '1',
							'name'	=> 'Begin aan todo opdracht in laravel',
							'done' => true
						),
					array(
							'owner_id'	=> '1',
							'name'	=> 'Studeer voor compositing',
							'done' => false
						),
					array(
							'owner_id'	=> '1',
							'name'	=> 'Maak samenvatting voor marketing',
							'done' => false
						)
				);

			DB::table('items')->insert( $items );
		}
	}


?>