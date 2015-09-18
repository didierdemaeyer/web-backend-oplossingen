<?php
	
	session_start();
	spl_autoload_register(  function( $class ) { include_once( $class .'.php' ); } );
	function view( $file, $data = false )
	{
		if ( $data )
		{
			extract( $data );
		} 
		include( $file );
	}
	// Load todo class
	$todo	=	new Todo();
	// Add todo
	if ( isset( $_POST[ 'addTodo' ] ) )
	{
		if ( $_POST[ 'description' ] !== '' )
		{
			$description	=	$_POST[ 'description' ];
			$todo->add( $description );
		}
		else
		{
			Message::setMessage( 'Ahh, damn. Lege todos zijn niet toegestaan...' , 'error');
		}
	}
	// Check activation
	if ( isset( $_POST[ 'toggleTodo' ] ) )
	{
		$id		=	$_POST[ 'toggleTodo' ];	
		$todo->toggle( $id );
	}
	// Delete todo
	if ( isset( $_POST[ 'deleteTodo' ] ) )
	{
		$id	=	$_POST[ 'deleteTodo' ];
		
		$todo->delete( $id );
	}
	// Load todos
	$todoItems = $todo->getActiveItems( false );
	$doneItems = $todo->getActiveItems( true );
	view( 'header.view.php', array( 'title' => 'Todo App', 
									'messages' => Message::getMessages() ) );
	view( 'body.view.php', array( 'todoItems' => $todoItems, 
									'doneItems' => $doneItems ) );
	view( 'footer.view.php' );
?>