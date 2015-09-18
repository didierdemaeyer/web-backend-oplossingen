<?php
	
	// Config
	# URL is de link naar de server (meestal de domeinnaam)
	define('URL', 'http://' . dirname ( dirname( $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ) ) );

	define('SERVER_ROOT', dirname( dirname ( __FILE__ ) ));
	define( 'SYS_FOLDER', SERVER_ROOT . DIRECTORY_SEPARATOR.'framework'. DIRECTORY_SEPARATOR.'system'. DIRECTORY_SEPARATOR );
	define( 'APP_FOLDER', SERVER_ROOT . DIRECTORY_SEPARATOR.'framework'. DIRECTORY_SEPARATOR.'application'. DIRECTORY_SEPARATOR );

	$controller 	=	'Pages';
	$arguments		=	NULL;

	function autoload( $classname )
	{
		$classname = strtolower( $classname );

		$filename	=	$classname . '.php';
		$path		=	false;

		if ( file_exists( SYS_FOLDER . $filename ) )
		{
			$path 	=	SYS_FOLDER . $filename;
		}
		elseif( file_exists( APP_FOLDER .'model' . DIRECTORY_SEPARATOR . $filename ) )
		{
			$path 	=	APP_FOLDER .'model' . DIRECTORY_SEPARATOR . $filename;
		}
		elseif( file_exists( APP_FOLDER .'view' . DIRECTORY_SEPARATOR . $filename ) )
		{
			$path 	=	APP_FOLDER .'view' . DIRECTORY_SEPARATOR . $filename;
		}

		elseif( file_exists( APP_FOLDER . 'controller' . DIRECTORY_SEPARATOR . $filename ) )
		{
			$path 	=	APP_FOLDER .'controller' . DIRECTORY_SEPARATOR . $filename;
		}

		include_once( $path );
	}

	spl_autoload_register( "autoload" );

	if ( isset( $_GET[ 'hook' ] ) )
	{
		$hookGet	=	trim( $_GET[ 'hook' ], '/' );

		$hookArray	=	explode( '/', $hookGet );

		$controller	=	$hookArray[ 0 ];

		array_shift( $hookArray );

		$arguments	=	$hookArray;
	}

	$controller = new $controller( $arguments );


?>