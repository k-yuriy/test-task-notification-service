<?php

namespace App\Domain\Notifications\Jobs;

use App\Domain\Notifications\Services\SendNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendNotificationJob implements ShouldQueue
{
    use Queueable;

    public const string HIGH_PRIORITY_QUEUE_NAME = 'notifications.high';
    public const string DEFAULT_QUEUE_NAME = 'notifications.default';

    public int $tries = 4;

    public int $timeout = 90;

    public function __construct(
        public int $notificationId
    ) {
    }

    public function backoff(): array
    {
        return [10, 60, 120, 240];
    }

    public function handle(SendNotificationService $notificationService): void
    {
        $notificationService->send($this->notificationId);
    }
}
