<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum StatusEnum: string
{
    use InteractWithEnum;

    case PENDING     = 'pending';
    case PUBLISHED     = 'published';
}
