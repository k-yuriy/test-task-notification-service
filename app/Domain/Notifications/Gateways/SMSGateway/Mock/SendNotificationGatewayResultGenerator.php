<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway\Mock;

use App\Domain\Notifications\Gateways\SendNotificationGatewayResultInterface;

class SendNotificationGatewayResultGenerator
{
    public static function random(): SendNotificationGatewayResultInterface
    {
        return random_int(1, 100) <= 25
            ? new SendNotificationErrorGatewayResult()
            : new SendNotificationSuccessGatewayResult();
    }
}