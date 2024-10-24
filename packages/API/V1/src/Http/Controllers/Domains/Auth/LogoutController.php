<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Auth;

use Loctour\API\V1\Http\Controllers\APIController;

class LogoutController extends APIController
{
    public function __invoke()
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->executed();
    }
}
