<?php

	class View
	{

		public function show( $page, $data )
		{
			extract( $data );
			
			include( $page );
		}

	}

?>