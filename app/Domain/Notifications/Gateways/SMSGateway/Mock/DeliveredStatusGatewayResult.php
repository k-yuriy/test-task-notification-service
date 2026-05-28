<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway\Mock;

use App\Domain\Notifications\Gateways\CheckDeliveryStatusGatewayResultInterface;
use App\Domain\Notifications\Gateways\GatewayResultStatus;

class DeliveredStatusGatewayResult implements CheckDeliveryStatusGatewayResultInterface
{

    public function getDeliveryStatus(): GatewayResultStatus
    {
        return GatewayResultStatus::Delivered;
    }
}