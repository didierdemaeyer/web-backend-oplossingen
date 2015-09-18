<?php
	class Todo
	{
		protected $items;
		public function __construct()
		{
			$this->items	= 	false;
			
			$this->loadItems();
		}
		public function loadItems()
		{
			if ( isset( $_SESSION['todo'] ) )
			{
				$this->items 	=	&$_SESSION[ 'todo' ];
			}
			else
			{
				$_SESSION['todo'] = '';
			}
		}
		public function add( $description, $active = 0 , $timestamp = false )
		{
			$newTodo[ 'description' ]		=	$description;
			$newTodo[ 'active' ]			=	$active;
			$newTodo[ 'timestamp' ]			=	( $timestamp ) ? $timestamp : time();
			$this->items[]	=	$newTodo;
			$this->loadItems();
		}
		public function toggle( $id )
		{
			if ( isset( $this->items[ $id ] ) )
			{
				$status	=	$this->items[ $id ][ 'active' ]; 
				$this->items[ $id ][ 'active' ] = abs( $status - 1 );	
			}
		}
		public function delete( $id )
		{
			if ( isset( $this->items[ $id ] ) )
			{
				unset( $this->items[ $id ] );
			}
		}
		public function getItems( $id = false )
		{
			$items	=	$this->items;
			
			if ( $id && isset( $this->items[ $id ] ) )
			{ 	
				$items	=	$this->items[ $id ];
			}
			return $items;
		}
		public function getActiveItems( $status = false )
		{
			$items	=	false;
			if ( $this->items )
			{
				foreach( $this->items as $key => $item )
				{
					if ( $item['active'] == $status )
					{
						$items[ $key ] = $item;
					}
				}
			}
			
			return $items;
			
		}
	}
?>