<?php
	class Message
	{
		public static function setMessage( $text, $type )
		{
			$message[ 'text' ]		=	$text;
			$message[ 'type' ]		=	$type;
			$_SESSION['messages'][]	=	$message;
		}
		public static function getMessages( $id = false )
		{
			$messages	=	false;
			if ( isset( $_SESSION['messages'] ) )
			{
				$messages	=	$_SESSION[ 'messages' ];
				unset( $_SESSION[ 'messages' ] );
			}
			return $messages;
		}
	}
?>