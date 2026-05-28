<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\EmailGateway;

use App\Domain\Notifications\DTO\EmailReceiverData;
use App\Domain\Notifications\Gateways\CheckDeliveryStatusGatewayResultInterface;
use App\Domain\Notifications\Gateways\SendNotificationGatewayResultInterface;

interface EmailGatewayInterface
{

    public function send(EmailReceiverData $receiver, string $text): SendNotificationGatewayResultInterface;

    public function checkStatus(int $notificationId): CheckDeliveryStatusGatewayResultInterface;
}