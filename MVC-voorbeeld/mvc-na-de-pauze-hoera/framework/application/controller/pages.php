<?php

	class Pages
	{

		public function __construct()
		{
			$view 	=	new View();

			$view->show('header.php', array( 'title' => 'Home' ) );
			$view->show('home.php');
			$view->show('footer.php');
		}

	}

?>