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

Route::get('/login', function () {
    return view('loginreg');
});

Route::get('/place', function () {
    return view('place');
});

//Route::group(['prefix' => 'api'], function() {
//    Route::get('search', 'PlacesController@search');
//});
