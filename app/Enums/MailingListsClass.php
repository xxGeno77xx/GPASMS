<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * ==========Roles===========
 * 
 * @method static self Groupe_A()
 * @method static self Groupe_B()
 * @method static self Groupe_C()
 * @method static self Groupe_D()
 * @method static self Groupe_E()
 *
 */
class MailingListsClass extends Enum
{
    public static function values()
    {
        return [
            'Groupe_A' => 'Groupe A',
            'Groupe_B' => 'Groupe B',
            'Groupe_C' => 'Groupe C',
            'Groupe_D' => 'Groupe D',
            'Groupe_E' => 'Groupe E',
        ];
    }

}