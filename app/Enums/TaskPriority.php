<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TaskPriority: string
{
    use EnumTrait;

    case HIGH = 'High';
    case MEDIUM = 'Medium';
    case LOW = 'Low';
}
