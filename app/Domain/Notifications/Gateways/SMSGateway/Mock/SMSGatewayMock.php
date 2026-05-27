<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway\Mock;

use App\Domain\Notifications\DTO\SmsReceiverData;
use App\Domain\Notifications\Gateways\SMSGateway\SendNotificationResultInterface;
use App\Domain\Notifications\Gateways\SMSGateway\SMSGatewayInterface;

class SMSGatewayMock implements SMSGatewayInterface
{

    public function send(SmsReceiverData $receiver, string $text): SendNotificationResultInterface
    {
        return GatewayResultGenerator::random();
    }
}