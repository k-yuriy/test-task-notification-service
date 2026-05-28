<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway\Mock;

use App\Domain\Notifications\Gateways\SendNotificationGatewayResultInterface;

class SendNotificationErrorGatewayResult implements SendNotificationGatewayResultInterface
{

    public function isSuccess(): bool
    {
        return false;
    }

    public function getErrorMessage(): ?string
    {
        return 'some error';
    }
}