<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * ==========Roles===========
 * 
 * @method static self Mailing()
 *
 */
class NavigationGroupEnums extends Enum
{

    protected static function values(): array
    {
        return [
            'Mailing' => "Messagerie"
        ];
    }
}