<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Services;

use App\Domain\Notifications\DTO\EmailReceiverData;
use App\Domain\Notifications\Gateways\CheckDeliveryStatusGatewayResultInterface;
use App\Domain\Notifications\Gateways\EmailGateway\EmailGatewayInterface;
use App\Domain\Notifications\Gateways\SendNotificationGatewayResultInterface;
use App\Domain\Notifications\Models\Notification;

readonly class EmailNotificationSender implements NotificationSenderInterface
{

    public function __construct(private EmailGatewayInterface $emailGateway)
    {
    }

    public function send(Notification $notification): SendNotificationGatewayResultInterface
    {
        $receiver = EmailReceiverData::validateAndCreate(['receiver' => $notification->getReceiver()]);
        return $this->emailGateway->send($receiver, $notification->package->text);
    }

    public function checkDeliveryStatus(Notification $notification): CheckDeliveryStatusGatewayResultInterface
    {
        return $this->emailGateway->checkStatus($notification->id);
    }
}