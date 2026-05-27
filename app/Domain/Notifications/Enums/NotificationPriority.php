<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Enums;

enum NotificationPriority: string
{
    case Transactional = 'transactional';
    case Marketing = 'marketing';

    public function isTransactional(): bool
    {
        return $this === self::Transactional;
    }

}
