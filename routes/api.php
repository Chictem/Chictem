<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::resource('courses', 'CourseAPIController');

Route::resource('tags', 'TagAPIController');



Route::resource('experts', 'ExpertAPIController');

Route::resource('teachers', 'TeacherAPIController');

Route::resource('settings', 'SettingAPIController');

Route::resource('menus', 'MenuAPIController');

Route::resource('banners', 'BannerAPIController');

Route::resource('banner_items', 'BannerItemAPIController');