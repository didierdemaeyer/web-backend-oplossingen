<?php 

	/**
	* This class is used to add notification messages to the SESSION
	* and return the notification that is currently set
	*/
	class Notification
	{
		
		public function __construct( $type, $message)
		{
			$this->type = $type;
			$this->message = $message;

			//add notification to the SESSION
			$_SESSION[ 'notification' ][ 'type' ] = $this->type;
			$_SESSION[ 'notification' ][ 'message' ] = $this->message;
		}

		public function removeNotificationFromSession()
		{
			unset( $_SESSION[ 'notification' ] );
		}

		public function getNotification()
		{
			$notification = false;

			if ( isset( $_SESSION[ 'notification' ] )) {
				$notification[ 'type' ] = $_SESSION[ 'notification' ][ 'type' ];
				$notification[ 'message' ] = $_SESSION[ 'notification' ][ 'message' ];

				/* verwijder notificatie uit SESSION zodat de melding maar 1 keer wordt laten zien */
				self::removeNotificationFromSession();
			}
			return $notification;
		}
	}

 ?>