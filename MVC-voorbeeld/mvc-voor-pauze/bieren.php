<?php

	class Bieren extends Controller
	{
		public function __construct()
		{
			var_dump( "Hallo vanuit de bieren construct" );
			$this->bierenOverzicht();
		}

		private function bierenOverzicht()
		{
			$bierenModel	=	new Bieren_model();

			$bieren = $bierenModel->bieren();

			$view 	=	new View();

			$view->show( 'header.php', array( 'title' => 'Overzicht van de bieren' ) );
			$view->show( 'bieren_overview.php', array( 'bieren' => $bieren[ 'data' ] ) );
			$view->show( 'footer.php' );
		}
	}

?>