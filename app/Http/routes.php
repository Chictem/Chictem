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

Route::model('menu', 'App\Model\Menu');
Route::model('role', 'App\Model\Role');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'manage', 'middleware' => 'auth.manage', 'namespace' => 'Manage'], function () {
    Route::controller('home', 'HomeController');
    Route::resource('role', 'RoleController');
});

Route::group(['prefix' => 'manage', 'namespace' => 'Manage'], function () {
    Route::controllers([
        'auth' => 'AuthController',
        'password' => 'PasswordController',
    ]);
});
