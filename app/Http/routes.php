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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/checkin', function () {
    return view('checkin');
});
Route::get('api/checkin/user/{token}', 'CheckInController@indexuser');
Route::get('api/checkin/paquete/{paquete}', 'CheckInController@indexpaquete');
Route::post('api/checkin/envio', 'CheckInController@storecheck');
