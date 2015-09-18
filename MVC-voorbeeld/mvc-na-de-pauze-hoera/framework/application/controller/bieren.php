<?php

	class Bieren extends Controller
	{
		public function __construct( $arguments )
		{
			if ( empty( $arguments ) )
			{
				$this->bierenOverzicht();
			}
			elseif ( isset( $arguments[ 0 ] ) &&
						is_numeric( $arguments[ 0 ]  ) )
			{
				$this->bierenIndividueel( $arguments[ 0 ] );
			}
			
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

		private function bierenIndividueel( $id )
		{
			$bierenModel	=	new Bieren_model();

			$bier = $bierenModel->bieren( $id );

			$view 	=	new View();

			$view->show( 'header.php', array( 'title' => '' ) );
			$view->show( 'bieren_individueel.php', array( 'bier' => $bier[ 'data' ][0] ) );
			$view->show( 'footer.php' );
		}
	}

?>