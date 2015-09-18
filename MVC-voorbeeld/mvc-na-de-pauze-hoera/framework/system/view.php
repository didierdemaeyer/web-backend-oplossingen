<?php

	class View
	{

		public function show( $page, $data = false )
		{
			if ( $data )
			{
				extract( $data );
			}
			
			include( APP_FOLDER . 'view' . DIRECTORY_SEPARATOR . $page );
		}

	}

?>