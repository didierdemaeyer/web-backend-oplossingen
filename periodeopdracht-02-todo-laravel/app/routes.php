<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array( 'as' => '/', 'uses' => 'HomeController@getIndex' ));

// Dit roept de getIndex methode aan van de HomeController.php die in de map controllers staat
// Route::get('/', 'HomeController@getIndex');



// Login - Logout
Route::get('login', array( 'as' => 'login', 'uses' => 'AuthController@getLogin'))->before('guest');
Route::post('login', 'AuthController@postLogin')->before('csrf');	/* tegen csrf */
Route::get('logout', array( 'as' => 'logout', 'uses' => 'AuthController@logout'))->before('auth');

// Register
Route::get('register', array( 'as' => 'register', 'uses' => 'RegisterController@getRegister'))->before('guest');
Route::post('register', 'RegisterController@postRegister')->before('csrf');


// Dashboard
Route::get('dashboard', array( 'as' => 'dashboard', 'uses' => 'HomeController@getDashboard'))->before('auth');


// Todo Applicatie
Route::get('todo', array( 'as' => 'todo', 'uses' => 'TodoController@getTodo'))->before('auth');

Route::get('todo/add', array( 'as' => 'todo/add', 'uses' => 'TodoController@getAddItem'))->before('auth');
Route::post('todo/add', 'TodoController@postAddItem')->before('csrf');

Route::get('todo/activate/{id}', array( 'as' => 'todo/activate', 'uses' => 'TodoController@activateItem'))->before('auth');
Route::get('todo/delete/{id}', array( 'as' => 'todo/delete', 'uses' => 'TodoController@deleteItem'))->before('auth');



?>