<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Interfaces;

use App\Domain\Notifications\Gateways\SMSGateway\SendNotificationResultInterface;
use App\Domain\Notifications\Models\Notification;

interface NotificationSenderInterface
{
    public function send(Notification $notification): SendNotificationResultInterface;
}