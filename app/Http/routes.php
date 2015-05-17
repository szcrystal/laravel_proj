<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@getIndex');
Route::controller('post', 'PagesController');

Route::get('dashboard', 'AuthorController@getIndex');
Route::controller('dashboard', 'AuthorController');
//Route::controller('admin', 'AuthorController');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
    'admin' => 'Admin\AdminController',
]);

