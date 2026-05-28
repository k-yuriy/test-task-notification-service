<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Services;

use App\Domain\Notifications\Gateways\CheckDeliveryStatusGatewayResultInterface;
use App\Domain\Notifications\Gateways\SendNotificationGatewayResultInterface;
use App\Domain\Notifications\Models\Notification;

interface NotificationSenderInterface
{
    public function send(Notification $notification): SendNotificationGatewayResultInterface;

    public function checkDeliveryStatus(Notification $notification): CheckDeliveryStatusGatewayResultInterface;
}