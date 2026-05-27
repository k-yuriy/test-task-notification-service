<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway;

enum GatewayResultStatus: string
{
    case Accepted = 'accepted';
    case Delivered = 'delivered';
    case Error = 'error';
}
