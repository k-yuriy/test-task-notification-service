<?php

declare(strict_types=1);

namespace App\SMSGateway\Mock;

use App\SMSGateway\GatewayResultStatus;
use App\SMSGateway\SendNotificationResultInterface;

class SuccessGatewayResult implements SendNotificationResultInterface
{

    public function isSuccess(): bool
    {
        return true;
    }

    public function getErrorMessage(): ?string
    {
        return null;
    }

    public function getStatus(): GatewayResultStatus
    {
        return GatewayResultStatus::Accepted;
    }
}