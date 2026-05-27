<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\NotificationChannel;
use App\Exceptions\InvalidArgumentException;
use App\Interfaces\NotificationSenderInterface;

final readonly class NotificationSenderResolver
{
    public function __construct(
        private EmailNotificationSender $emailSender,
        private SmsNotificationSender $smsSender,
    ) {
    }

    public function resolve(NotificationChannel $channel): NotificationSenderInterface
    {
        return match ($channel) {
            NotificationChannel::Email => $this->emailSender,
            NotificationChannel::Sms   => $this->smsSender,
            default                    => throw new InvalidArgumentException("Unsupported notification channel: {$channel->value}"),
        };
    }
}