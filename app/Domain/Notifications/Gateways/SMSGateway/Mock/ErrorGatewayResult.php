<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway\Mock;

use App\Domain\Notifications\Gateways\SMSGateway\GatewayResultStatus;
use App\Domain\Notifications\Gateways\SMSGateway\SendNotificationResultInterface;

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