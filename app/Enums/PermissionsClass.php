<?php

namespace App\Enums;

use \Spatie\Enum\Enum;

/**
 * ======Mailing-list permissions======
 * 
 * @method static self mailingListCreate()
 * @method static self mailingListRead()
 * @method static self mailingListEdit()
 * @method static self mailingListDelete()
 * 
 * ===========SMS permissions==========
 * 
 * @method static self smsSend()
 * @method static self smsRead()
 * 
 * =====User Management permissions====
 * 
 * @method static self userCreate()
 * @method static self userRead()
 * @method static self userEdit()
 * @method static self userDelete()
 * 
 * =======Staff permissions============
 * 
 * @method static self staffCreate()
 * @method static self staffRead()
 * @method static self staffEdit()
 * @method static self staffDelete()
 * 
 */
class PermissionsClass extends Enum
{

}