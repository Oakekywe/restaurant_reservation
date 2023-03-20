<?php

namespace App\Enums;

enum TableStatusEnum: string
{
    case Pending = 'pending';
    case Available = 'available';
    case Unavailable = 'unavailable';
}
