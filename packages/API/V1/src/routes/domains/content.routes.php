<?php


Route::group(['prefix' => 'content', 'namespace' => 'Content'], static function () {
    Route::group(['prefix' => 'post'], function (){
        Route::post('/','PostController@store');
    });
});
