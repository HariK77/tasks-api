<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TaskStatus: string
{
    use EnumTrait;

    case NEW = 'New';
    case INCOMPLETE = 'Incomplete';
    case COMPLETE = 'Complete';
}
