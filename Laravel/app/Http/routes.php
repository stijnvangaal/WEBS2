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
use Illuminate\Database\Eloquent\Model;


Route::get('/', 'HomeController@index');
//Route::get('/', function(){
//
//    /*$controller = new \App\Http\Controllers\HomeController();*/
//    $data['SingleCar'] = 'App'/auto::find(2);
//    $data['AllCars'] = array(model/auto::find(2));
//    return view::make('index', $data);
//});
