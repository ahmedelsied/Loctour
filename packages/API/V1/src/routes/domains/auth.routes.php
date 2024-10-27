<?php


Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], static function () {
    Route::post('login','LoginController');
    Route::post('register','RegisterController');
    Route::group(['middleware' => 'auth:sanctum'], static function () {
//        Route::delete('logout','LogoutController');
    });
});
