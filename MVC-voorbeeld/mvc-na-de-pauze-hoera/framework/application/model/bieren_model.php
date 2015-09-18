<?php

	class Bieren_model extends Model
	{

		public function bieren( $id = false )
		{
			$bindValues	=	false;
			$query 		=	'SELECT * FROM bieren';

			if ( $id !== false )
			{
				$query .= ' WHERE biernr = :id';

				$bindValues	=	array( ':id' => $id );
			}

			$bieren = $this->query( $query, $bindValues );

			return $bieren;
		}
	}

?>