<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway;

use App\Domain\Notifications\DTO\SmsReceiverData;

class SMSGateway implements SMSGatewayInterface
{

    public function send(SmsReceiverData $receiver, string $text): SendNotificationResultInterface
    {
        throw new \Exception('Not implemented');
    }
}