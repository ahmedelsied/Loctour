<?php

namespace Loctour\API\V1\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Loctour\API\V1\Support\Services\APIResponse\ApiResponse;

class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->status){
            return $next($request);
        }
        auth()->user()->currentAccessToken()->delete();
        return ApiResponse::error(__('Your account has been banned.'), 401);

    }
}
