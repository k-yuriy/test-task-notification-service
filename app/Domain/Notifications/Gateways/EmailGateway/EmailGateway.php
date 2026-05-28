<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\EmailGateway;

use App\Domain\Notifications\DTO\EmailReceiverData;

class EmailGateway implements EmailGatewayInterface
{

    public function send(EmailReceiverData $receiver, string $text): SendNotificationGatewayResultInterface
    {
        throw new \Exception('Not implemented');
    }

    public function checkStatus(int $notificationId): CheckDeliveryStatusGatewayResultInterface
    {
        throw new \Exception('Not implemented');
    }
}