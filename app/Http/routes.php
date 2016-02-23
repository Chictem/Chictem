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

Route::group(['prefix' => 'manage', 'middleware' => 'auth.admin', 'namespace' => 'Manage'], function () {

});

Route::group(['prefix' => 'manage', 'namespace' => 'Manage'], function () {
    Route::controllers([
        'auth' => 'AuthController',
        'password' => 'PasswordController',
    ]);
});
