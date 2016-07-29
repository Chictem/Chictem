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

use Laracasts\Flash\Flash;

Route::model('menu', 'App\Models\Menu');
Route::model('role', 'App\Models\Role');

Route::get('/', function () {
	Flash::success('ssss');
    return view('welcome');
});

Route::group(['prefix' => 'manage', 'middleware' => 'auth.manage', 'namespace' => 'Manage'], function () {
    Route::controller('home', 'HomeController');
    Route::controller('role', 'RoleController');
    Route::resource('role', 'RoleController');
    Route::controller('option', 'OptionController');
    Route::resource('menu', 'MenuController');
});

Route::group(['prefix' => 'manage', 'namespace' => 'Manage'], function () {
    Route::controllers([
        'auth' => 'AuthController',
        'password' => 'PasswordController',
    ]);
});
