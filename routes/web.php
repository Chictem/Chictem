<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();

Route::get('/', 'HomeController@index');

//Route::resource('courses', 'CourseController');

try {
	foreach (DataType::all() as $dataTypes) {
		Route::resource($dataTypes->slug, 'AppBaseController', [
			'as' => '',
		]);
	}
} catch (InvalidArgumentException $e) {
	throw new InvalidArgumentException("Custom routes hasn't been configured because: " . $e->getMessage(), 1);
} catch (Exception $e) {
	// do nothing, might just be because table not yet migrated.
}

//Route::resource('tags', 'TagController');

//Route::resource('experts', 'ExpertController');

//Route::resource('teachers', 'TeacherController');

//Route::resource('settings', 'SettingController');

//Route::resource('menus', 'MenuController');

//Route::resource('banners', 'BannerController');

//Route::resource('bannerItems', 'BannerItemController');

//Route::resource('courses', 'CourseController');

try {
	foreach (Page::all() as $page) {
		if (! start_with_digit($page->slug)) {
			Route::get($page->slug, ['as' => 'page.' . $page->slug, 'use' => 'PageController@index']);
		}
	}
} catch (InvalidArgumentException $e) {
	throw new InvalidArgumentException("Custom routes hasn't been configured because: " . $e->getMessage(), 1);
} catch (Exception $e) {
	// do nothing, might just be because table not yet migrated.
}