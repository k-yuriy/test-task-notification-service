<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway\Mock;


use App\Domain\Notifications\Gateways\CheckDeliveryStatusGatewayResultInterface;

class CheckDeliveryStatusGatewayResultGenerator
{
    public static function random(): CheckDeliveryStatusGatewayResultInterface
    {
        return random_int(1, 100) <= 25
            ? new DeliveredStatusGatewayResult()
            : new NotDeliveredStatusGatewayResult();
    }
}