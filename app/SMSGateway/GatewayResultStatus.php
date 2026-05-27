<?php

declare(strict_types=1);

namespace App\SMSGateway;

enum GatewayResultStatus: string
{
    case Accepted = 'accepted';
    case Delivered = 'delivered';
    case Error = 'error';
}
