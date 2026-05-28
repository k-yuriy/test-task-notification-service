<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Services;

use App\Domain\Notifications\DTO\SmsReceiverData;
use App\Domain\Notifications\Gateways\CheckDeliveryStatusGatewayResultInterface;
use App\Domain\Notifications\Gateways\SendNotificationGatewayResultInterface;
use App\Domain\Notifications\Gateways\SMSGateway\SMSGatewayInterface;
use App\Domain\Notifications\Models\Notification;

readonly class SmsNotificationSender implements NotificationSenderInterface
{

    public function __construct(private SMSGatewayInterface $smsGateway)
    {
    }

    public function send(Notification $notification): SendNotificationGatewayResultInterface
    {
        $receiver = SmsReceiverData::validateAndCreate(['receiver' => $notification->getReceiver()]);
        return $this->smsGateway->send($receiver, $notification->package->text);
    }

    public function checkDeliveryStatus(Notification $notification): CheckDeliveryStatusGatewayResultInterface
    {
        return $this->smsGateway->checkStatus($notification->id);
    }
}