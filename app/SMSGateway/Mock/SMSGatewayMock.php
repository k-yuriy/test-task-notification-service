<?php

declare(strict_types=1);

namespace App\SMSGateway\Mock;

use App\DTO\SmsReceiverData;
use App\SMSGateway\SendNotificationResultInterface;
use App\SMSGateway\SMSGatewayInterface;

class SMSGatewayMock implements SMSGatewayInterface
{

    public function send(SmsReceiverData $receiver, string $text): SendNotificationResultInterface
    {
        return GatewayResultGenerator::random();
    }
}