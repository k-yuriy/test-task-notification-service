<?php

namespace App\Domain\Notifications\Jobs;

use App\Domain\Notifications\Services\CheckNotificationStatusService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CheckNotificationStatusJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $timeout = 60;

    public const string QUEUE_NAME = 'notification-status-checks.default';

    /**
     * Create a new job instance.
     */
    public function __construct(public int $notificationId)
    {
    }

    public function backoff(): array
    {
        return [10, 30];
    }

    /**
     * Execute the job.
     */
    public function handle(CheckNotificationStatusService $service): void
    {
        $service->checkNotification($this->notificationId);
    }
}
