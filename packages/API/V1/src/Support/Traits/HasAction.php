<?php

namespace Loctour\API\V1\Support\Traits;

trait HasAction
{
    public static function new(): self
    {
        return new static();
    }
}
