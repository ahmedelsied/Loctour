<?php


Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], static function () {
    Route::post('login','LoginController');
    Route::post('register','RegisterController');
    Route::post('verify-phone','VerifyPhoneController');
    Route::group(['middleware' => 'auth:sanctum'], static function () {
//        Route::delete('logout','LogoutController');
    });
});
