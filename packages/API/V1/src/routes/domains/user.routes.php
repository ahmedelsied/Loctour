<?php


Route::group(['prefix' => 'user', 'namespace' => 'User'], static function () {
    Route::put('/account','AccountController@update');
    Route::delete('/account','AccountController@delete');
});
