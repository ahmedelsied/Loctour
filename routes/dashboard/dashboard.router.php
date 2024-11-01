<?php

use App\Support\Dashboard\ChangeLocalizationAction;
use App\Http\Middleware\LocalizationMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' =>  LocalizationMiddleware::class], function () {
    require __DIR__.'/auth.routes.php';

    Route::group(['middleware' => 'auth'], static function () {
        Route::group(['namespace' => 'App\\Http\\Controllers\\Dashboard'], static function () {
            Route::view('/', 'dashboard.home')->name('home');

            Route::get('change-language/{locale}', [ChangeLocalizationAction::class, '__invoke'])
                 ->name('change-language');

            require __DIR__.'/core.routes.php';
        });
    });
});
