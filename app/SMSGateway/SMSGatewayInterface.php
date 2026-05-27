<?php

declare(strict_types=1);

namespace App\SMSGateway;

use App\DTO\SmsReceiverData;

interface SMSGatewayInterface
{

    public function send(SmsReceiverData $receiver, string $text): SendNotificationResultInterface;
}