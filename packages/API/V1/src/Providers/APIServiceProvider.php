<?php

namespace Loctour\API\V1\Providers;

use Loctour\API\V1\Support\Services\APIResponse\JsonResponder;
use Illuminate\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->singleton('api-responder', function () {
            return new JsonResponder();
        });
    }

    public function boot()
    {
    }
}
