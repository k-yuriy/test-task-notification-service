<?php

declare(strict_types=1);

namespace App\SMSGateway\Mock;

use App\SMSGateway\GatewayResultStatus;
use App\SMSGateway\SendNotificationResultInterface;

class ErrorGatewayResult implements SendNotificationResultInterface
{

    public function isSuccess(): bool
    {
        return false;
    }

    public function getErrorMessage(): ?string
    {
        return 'some error';
    }

    public function getStatus(): GatewayResultStatus
    {
        return GatewayResultStatus::Error;
    }
}