<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Services;

use App\Domain\Notifications\DTO\SmsReceiverData;
use App\Domain\Notifications\Gateways\SMSGateway\SendNotificationResultInterface;
use App\Domain\Notifications\Gateways\SMSGateway\SMSGatewayInterface;
use App\Domain\Notifications\Interfaces\NotificationSenderInterface;
use App\Domain\Notifications\Models\Notification;

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