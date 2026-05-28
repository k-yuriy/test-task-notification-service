<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway;

use App\Domain\Notifications\DTO\SmsReceiverData;
use App\Domain\Notifications\Gateways\CheckDeliveryStatusGatewayResultInterface;
use App\Domain\Notifications\Gateways\SendNotificationGatewayResultInterface;

class SMSGateway implements SMSGatewayInterface
{

    public function send(SmsReceiverData $receiver, string $text): SendNotificationGatewayResultInterface
    {
        throw new \Exception('Not implemented');
    }

    public function checkStatus(int $notificationId): CheckDeliveryStatusGatewayResultInterface
    {
        throw new \Exception('Not implemented');
    }
}