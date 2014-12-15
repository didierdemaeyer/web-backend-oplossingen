<?php 

	/**
	* This class is used to connect to the database
	* and return the the requested data and fieldnames
	*/
	class Database
	{
		private $db;
		
		public function __construct( $db )
		{
			$this->db = $db;
		}

		public function query( $queryString, $parameters )
		{
			$statement = $this->db->prepare( $queryString );

			if ( $parameters ) {
				foreach ($parameters as $parameter => $value) {
					$statement->bindValue( $parameter, $value );
				}
			}

			$statement->execute();

			/* data ophalen */
			$data = array();
			while ($row = $statement->fetch( PDO::FETCH_ASSOC )) {
				$data[] = $row;
			}

			/* veldnamen ophalen */
			$fieldnames = array();
			if ( isset( $data[ 0 ]) ) {
				foreach ($data[0] as $key => $value) {
					$fieldnames[] = $key;
				}
			}
			

			$returnArray[ 'fieldnames' ] = $fieldnames;
			$returnArray[ 'data' ] = $data;

			return $returnArray;
		}
	}

 ?>