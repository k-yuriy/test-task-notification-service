<?php

declare(strict_types=1);

namespace App\SMSGateway;

use App\DTO\SmsReceiverData;

class SMSGateway implements SMSGatewayInterface
{

    public function send(SmsReceiverData $receiver, string $text): SendNotificationResultInterface
    {
        throw new \Exception('Not implemented');
    }
}