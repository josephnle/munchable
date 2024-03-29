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

Route::get('/', 'PlacesController@search');
Route::get('/places/{id}', 'PlacesController@show');

Route::get('/login', function () {
    return view('loginreg');
});

Route::get('/saved', 'PlacesController@showSaved');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'api'], function() {
    Route::post('save', 'PlacesController@save');
});
