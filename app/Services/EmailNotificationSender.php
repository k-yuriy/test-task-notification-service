<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\NotificationSenderInterface;
use App\Models\Notification;
use App\SMSGateway\SendNotificationResultInterface;

class EmailNotificationSender implements NotificationSenderInterface
{

    public function send(Notification $notification): SendNotificationResultInterface
    {
        return new SendNotificationResultInterface();
    }
}