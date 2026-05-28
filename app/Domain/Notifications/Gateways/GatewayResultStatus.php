<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways;

enum GatewayResultStatus: string
{
    case Accepted = 'accepted';
    case Delivered = 'delivered';
    case Error = 'error';

    public function isDelivered(): bool
    {
        return $this === self::Delivered;
    }
}
