<?php

Route::group(['prefix' => 'v1'], function (){

    Route::group(['prefix' => 'domains', 'namespace' => 'Domains'], static function () {
        require __DIR__.'/domains/auth.routes.php';
        Route::group(['middleware' => ['auth:sanctum']], static function () {
            require __DIR__.'/domains/core.routes.php';
            require __DIR__.'/domains/user.routes.php';
            require __DIR__.'/domains/content.routes.php';
            // require __DIR__.'/domains/*.routes.php';

        });
    });

    Route::group(['middleware' => ['auth:sanctum']], static function () {
        require __DIR__.'/data.routes.php';
        require __DIR__.'/actions.routes.php';
    });

});
