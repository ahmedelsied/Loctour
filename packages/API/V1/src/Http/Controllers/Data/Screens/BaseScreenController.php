<?php

namespace Loctour\API\V1\Http\Controllers\Data\Screens;

use Loctour\API\V1\Http\Controllers\APIController;

class BaseScreenController extends APIController
{
    public function __invoke()
    {
        return $this->executed();
    }
}
