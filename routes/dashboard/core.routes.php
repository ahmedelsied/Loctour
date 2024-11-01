<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'core', 'as' => 'core.', 'namespace' => 'Core'], function () {
    Route::get('profile', 'AdminProfileController@index')->name('profile');
    Route::put('profile', 'AdminProfileController@update');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
});
