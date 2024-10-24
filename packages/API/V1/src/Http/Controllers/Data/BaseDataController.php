<?php

namespace Loctour\API\V1\Http\Controllers\Data;

use Loctour\API\V1\Http\Controllers\APIController;

class BaseDataController extends APIController
{
    public function __invoke()
    {
        return $this->executed();
    }
}
