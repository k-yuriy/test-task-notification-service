<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway\Mock;

use App\Domain\Notifications\Gateways\SendNotificationGatewayResultInterface;

class SendNotificationSuccessGatewayResult implements SendNotificationGatewayResultInterface
{

    public function isSuccess(): bool
    {
        return true;
    }

    public function getErrorMessage(): ?string
    {
        return null;
    }
}