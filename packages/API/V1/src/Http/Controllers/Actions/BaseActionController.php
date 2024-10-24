<?php

namespace Loctour\API\V1\Http\Controllers\Actions;

use Loctour\API\V1\Http\Controllers\APIController;

class BaseActionController extends APIController
{
    public function __invoke()
    {
        return $this->executed();
    }
}
