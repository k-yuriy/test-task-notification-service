<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Notification;
use App\SMSGateway\SendNotificationResultInterface;

interface NotificationSenderInterface
{
    public function send(Notification $notification): SendNotificationResultInterface;
}