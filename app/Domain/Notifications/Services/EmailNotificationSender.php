<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Services;

use App\Domain\Notifications\Gateways\SMSGateway\SendNotificationResultInterface;
use App\Domain\Notifications\Interfaces\NotificationSenderInterface;
use App\Domain\Notifications\Models\Notification;

class EmailNotificationSender implements NotificationSenderInterface
{

    public function send(Notification $notification): SendNotificationResultInterface
    {
        return new SendNotificationResultInterface();
    }
}