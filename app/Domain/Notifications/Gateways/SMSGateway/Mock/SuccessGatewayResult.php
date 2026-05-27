<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway\Mock;

use App\Domain\Notifications\Gateways\SMSGateway\GatewayResultStatus;
use App\Domain\Notifications\Gateways\SMSGateway\SendNotificationResultInterface;

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