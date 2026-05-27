<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Services;

use App\Domain\Notifications\Enums\NotificationChannel;
use App\Domain\Notifications\Exceptions\InvalidArgumentException;
use App\Domain\Notifications\Interfaces\NotificationSenderInterface;

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