<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\SmsReceiverData;
use App\Interfaces\NotificationSenderInterface;
use App\Models\Notification;
use App\SMSGateway\SendNotificationResultInterface;
use App\SMSGateway\SMSGatewayInterface;

class SmsNotificationSender implements NotificationSenderInterface
{

    public function __construct(private SMSGatewayInterface $smsGateway)
    {
    }

    public function send(Notification $notification): SendNotificationResultInterface
    {
        $receiver = SmsReceiverData::validateAndCreate(['receiver' => $notification->getReceiver()]);
        return $this->smsGateway->send($receiver, $notification->package->text);
    }
}