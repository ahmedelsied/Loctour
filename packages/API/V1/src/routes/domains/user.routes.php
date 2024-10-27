<?php

Route::group(['prefix' => 'account'], function (){
});


Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => 'auth:sanctum'], static function () {
    Route::put('/account','AccountController@update');
    Route::delete('/account/delete','AccountController@delete');
});
