<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * ==========Roles===========
 * 
 * @method static self Conges()
 * @method static self Permission()
 * @method static self CongeMaladie()
 *
 */
class LeaveMotivesClass extends Enum
{

    protected static function values(): array
    {
        return [
            'Conges' => "Congés",
            "CongeMaladie" => "Congés maladie",
            "CongeMaternite" => "Congés maternité",
            "CongeMaladie" => "Congés maladie",

        ];
    }
}