<?php

/*
|--------------------------------------------------------------------------
| Voyager Routes
|--------------------------------------------------------------------------
|
| This file is where you may override any of the routes that are included
| with Voyager.
|
*/

Route::group(['as' => 'voyager.'], function () {
    event('voyager.routing', app('router'));

    Route::get('login', ['uses' => 'VoyagerAuthController@login', 'as' => 'login']);
    Route::post('login', ['uses' => 'VoyagerAuthController@postLogin', 'as' => 'postlogin']);

    Route::group(['middleware' => ['admin.user']], function () {
        event('voyager.admin.routing', app('router'));

        // Main Admin and Logout Route
        Route::get('/', ['uses' => 'VoyagerController@index', 'as' => 'dashboard']);
        Route::get('logout', ['uses' => 'VoyagerController@logout', 'as' => 'logout']);
        Route::post('upload', ['uses' => 'VoyagerController@upload', 'as' => 'upload']);
        Route::get('upgrade', ['uses' => 'VoyagerUpgradeController@index', 'as' => 'upgrade']);

        Route::get('profile', ['uses' => 'VoyagerController@profile', 'as' => 'profile']);

        try {
            foreach (App\Models\DataType::all() as $dataTypes) {
                Route::resource($dataTypes->slug, 'VoyagerBreadController');
            }
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException("Custom routes hasn't been configured because: ".$e->getMessage(), 1);
        } catch (\Exception $e) {
            // do nothing, might just be because table not yet migrated.
        }

        // Role Routes
        Route::resource('roles', 'VoyagerRoleController');

        // Menu Routes
        Route::group([
            'as'     => 'menus.',
            'prefix' => 'menus/{menu}',
        ], function () {
            Route::get('builder', ['uses' => 'VoyagerMenuController@builder', 'as' => 'builder']);
            Route::post('order', ['uses' => 'VoyagerMenuController@order_item', 'as' => 'order']);

            Route::group([
                'as'     => 'item.',
                'prefix' => 'item',
            ], function () {
                Route::delete('{id}', ['uses' => 'VoyagerMenuController@delete_menu', 'as' => 'destroy']);
                Route::post('/', ['uses' => 'VoyagerMenuController@add_item', 'as' => 'add']);
                Route::put('/', ['uses' => 'VoyagerMenuController@update_item', 'as' => 'update']);
            });
        });

        // Settings
        Route::group([
            'as'     => 'settings.',
            'prefix' => 'settings',
        ], function () {
            Route::get('/', ['uses' => 'VoyagerSettingsController@index', 'as' => 'index']);
            Route::post('/', ['uses' => 'VoyagerSettingsController@store', 'as' => 'store']);
            Route::put('/', ['uses' => 'VoyagerSettingsController@update', 'as' => 'update']);
            Route::delete('{id}', ['uses' => 'VoyagerSettingsController@delete', 'as' => 'delete']);
            Route::get('{id}/move_up', ['uses' => 'VoyagerSettingsController@move_up', 'as' => 'move_up']);
            Route::get('{id}/move_down', ['uses' => 'VoyagerSettingsController@move_down', 'as' => 'move_down']);
            Route::get('{id}/delete_value', ['uses' => 'VoyagerSettingsController@delete_value', 'as' => 'delete_value']);
        });

        // Admin Media
        Route::group([
            'as'     => 'media.',
            'prefix' => 'media',
        ], function () {
            Route::get('/', ['uses' => 'VoyagerMediaController@index', 'as' => 'index']);
            Route::post('files', ['uses' => 'VoyagerMediaController@files', 'as' => 'files']);
            Route::post('new_folder', ['uses' => 'VoyagerMediaController@new_folder', 'as' => 'new_folder']);
            Route::post('delete_file_folder', ['uses' => 'VoyagerMediaController@delete_file_folder', 'as' => 'delete_file_folder']);
            Route::post('directories', ['uses' => 'VoyagerMediaController@get_all_dirs', 'as' => 'get_all_dirs']);
            Route::post('move_file', ['uses' => 'VoyagerMediaController@move_file', 'as' => 'move_file']);
            Route::post('rename_file', ['uses' => 'VoyagerMediaController@rename_file', 'as' => 'rename_file']);
            Route::post('upload', ['uses' => 'VoyagerMediaController@upload', 'as' => 'upload']);
        });

        // Database Routes
        Route::group([
            'as'     => 'database.',
            'prefix' => 'database',
        ], function () {
            Route::post('bread/create', ['uses' => 'VoyagerDatabaseController@addBread', 'as' => 'create_bread']);
            Route::post('bread/', ['uses' => 'VoyagerDatabaseController@storeBread', 'as' => 'store_bread']);
            Route::get('bread/{id}/edit', ['uses' => 'VoyagerDatabaseController@addEditBread', 'as' => 'edit_bread']);
            Route::put('bread/{id}', ['uses' => 'VoyagerDatabaseController@updateBread', 'as' => 'update_bread']);
            Route::delete('bread/{id}', ['uses' => 'VoyagerDatabaseController@deleteBread', 'as' => 'delete_bread']);
        });

        Route::resource('database', 'VoyagerDatabaseController');
    });
});
