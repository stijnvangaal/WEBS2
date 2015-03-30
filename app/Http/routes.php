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

Route::get('/Webshop', 'UserController@Webshop');
Route::get('/Webshop/{ID}', 'UserController@WebshopSelection');
Route::get('/car/{ID}', 'HomeController@Car');
Route::post('/car/BigPicture','HomeController@BigPicture');

Route::get('Cart', 'UserController@Cart');
Route::post('Cart', 'UserController@ChangeCartAmount');
Route::get('DeleteFromCart/{ID}', 'UserController@DeleteFromCart');
Route::get('AddToCart/{ID}', 'UserController@AddToCart');

Route::get('Order', 'UserController@Order');
Route::get('DoCheckOut', 'UserController@DoCheckOut');

Route::get('Login', 'UserController@Login');
Route::get('User', 'UserController@Userpage');
Route::post('User', 'UserController@DoLogin');
Route::get('Logout', 'UserController@DoLogOut');

Route::get('Register', 'UserController@Register');
Route::post('Register', 'UserController@DoRegister');

//admin
Route::get('Admin/', 'HomeController@AdminHome');
Route::get('Admin/Types', 'AdminTypeController@TypeIndex');
Route::post('Admin/AddType', 'AdminTypeController@AddType');
Route::post('Admin/DeleteType', 'AdminTypeController@DeleteType');
Route::resource('Admin/Cars', 'AdminCarsController');
//Route::get('AdminCars', 'AdminCarsController@index');
//Route::post('AdminCars/destroy/{id}', 'AdminCarsController@destroy');
