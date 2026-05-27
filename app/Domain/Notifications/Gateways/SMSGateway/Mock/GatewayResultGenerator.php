<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway\Mock;

use App\Domain\Notifications\Gateways\SMSGateway\SendNotificationResultInterface;

class GatewayResultGenerator
{
    public static function random(): SendNotificationResultInterface
    {
        return random_int(1, 100) <= 25
            ? new ErrorGatewayResult()
            : new SuccessGatewayResult();
    }
}