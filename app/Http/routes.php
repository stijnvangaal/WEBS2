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

Route::get('/', 'HomeController@index');
Route::get('About', 'HomeController@about');

Route::get('/car/{ID}', 'HomeController@Car');

Route::get('Cart', 'UserController@Cart');
Route::get('DeleteFromCart/{ID}', 'UserController@DeleteFromCart');
Route::get('AddToCart/{ID}', 'UserController@AddToCart');

Route::get('Login', 'UserController@Login');
Route::get('User', 'UserController@Userpage');
Route::post('User', 'UserController@DoLogin');
Route::get('Logout', 'UserController@DoLogOut');