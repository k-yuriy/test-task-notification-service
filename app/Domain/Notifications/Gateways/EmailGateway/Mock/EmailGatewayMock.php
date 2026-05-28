<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\EmailGateway\Mock;

use App\Domain\Notifications\DTO\EmailReceiverData;
use App\Domain\Notifications\Gateways\CheckDeliveryStatusGatewayResultInterface;
use App\Domain\Notifications\Gateways\EmailGateway\EmailGatewayInterface;
use App\Domain\Notifications\Gateways\SendNotificationGatewayResultInterface;

class EmailGatewayMock implements EmailGatewayInterface
{

    public function send(EmailReceiverData $receiver, string $text): SendNotificationGatewayResultInterface
    {
        return SendNotificationGatewayResultGenerator::random();
    }

    public function checkStatus(int $notificationId): CheckDeliveryStatusGatewayResultInterface
    {
        return CheckDeliveryStatusGatewayResultGenerator::random();
    }
}