<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Enums;

enum NotificationStatus: string
{
    case Queued = 'queued';
    case Sent = 'sent';
    case Delivered = 'delivered';
    case Error = 'error';

    public function isQueued(): bool
    {
        return $this === self::Queued;
    }

    public function isError(): bool
    {
        return $this === self::Error;
    }

    public function isReadyForSend(): bool
    {
        return $this->isQueued() || $this->isError() ;
    }
}