<?php

namespace Loctour\API\V1\Http\Middlewares;

use Closure;
use Loctour\API\V1\Support\Exceptions\APIExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;

class APIHandlerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        app()->singleton(
            ExceptionHandler::class,
            APIExceptionHandler::class
        );

        return $next($request);
    }
}
