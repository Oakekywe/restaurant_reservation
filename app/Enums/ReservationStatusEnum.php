<?php

namespace App\Enums;

enum ReservationStatusEnum: string
{
    case Pending = 'pending';
    case Rejected = 'rejected';
    case Confirmed = 'confirmed';
}
