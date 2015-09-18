<?php

	class Bieren_model extends Model
	{

		public function bieren( $id = false )
		{
			$bieren = $this->query('SELECT * FROM bieren');

			return $bieren;
		}
	}

?>