<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways;

interface CheckDeliveryStatusGatewayResultInterface
{
    public function getDeliveryStatus(): GatewayResultStatus;
}