<?php

namespace App\Domain\Core\Enums;

use Spatie\Enum\Laravel\Enum;


/**
 * @method static self ios()
 * @method static self android()
 */
class DevicesEnum extends Enum
{
    public static function toRequestValidation()
    {
        return 'in:'.implode(",",DevicesEnum::toValues());
    }
}
