<?php 

/**
* 
*/
class TodoController extends BaseController
{
	
	public function getTodo()
	{
		$items = Auth::user()->items;		/* items is een functie, maar je roept een property aan -> reden: eager loading */

		return View::make('todo')->with( 'items', $items );
	}

	public function getAddItem()
	{
		return View::make('add');
	}

	public function postAddItem()
	{
		$rules = array( 'description' => 'required|min:3|max:100');
		$validator = Validator::make( Input::all(), $rules );

		if ( $validator->fails() ) {
			return Redirect::route('todo/add')->withErrors( $validator );
		}

		/* Item toevoegen aan DB */
		$item = new Item;
		$item->name = Input::get('description');
		$item->owner_id = Auth::user()->id;
		$item->save();

		return Redirect::to('todo')->with( 'message', 'Het item "' . Input::get('description') . '" is toegevoegd.');
	}

	public function activateItem( $id )
	{
		/* Boolean done opvragen van het item */
		$done = DB::table('items')
												->where('id', $id)
												->pluck('done');

		$done = !$done;

		/* boolean done van item veranderen en updaten in DB */
		DB::table('items')
								->where('id', $id)
								->update(array( 'done' => $done));

		if ( $done ) {
			$message = 'Alright! Dat is geschrapt.';
		}
		else {
			$message = 'Ai ai, nog meer werk...';
		}
		
		return Redirect::to('todo')->with( 'message', $message );
	}

	public function deleteItem( $id )
	{
		/* Naam van het item opvragen */
		$item = DB::table('items')
												->where('id', $id)
												->pluck('name');

		/* Item verwijderen uit DB */
		DB::table('items')
								->where('id', $id)
								->delete();

		return Redirect::to('todo')->with( 'message', 'Het item "' . $item . '" is succesvol verwijderd.' );
	}

}

 ?>