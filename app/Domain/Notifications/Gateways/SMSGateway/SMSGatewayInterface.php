<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway;

use App\Domain\Notifications\DTO\SmsReceiverData;

interface SMSGatewayInterface
{

    public function send(SmsReceiverData $receiver, string $text): SendNotificationResultInterface;
}