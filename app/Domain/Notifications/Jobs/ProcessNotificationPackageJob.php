<?php

namespace App\Domain\Notifications\Jobs;

use App\Domain\Notifications\Repositories\NotificationPackageRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessNotificationPackageJob implements ShouldQueue
{
    use Queueable;

    public const string QUEUE_NAME = 'notification-packages.default';

    public int $tries = 4;

    public int $timeout = 90;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $packageId
    ) {
    }

    public function backoff(): array
    {
        return [10, 60, 120, 240];
    }

    public function handle(
        NotificationPackageRepository $repository,
    ): void
    {
        $package = $repository->getById($this->packageId);
        $queueName = $package->getPriority()->isTransactional()
            ? SendNotificationJob::HIGH_PRIORITY_QUEUE_NAME
            : SendNotificationJob::DEFAULT_QUEUE_NAME;

        foreach ($package->notifications as $notification) {
            SendNotificationJob::dispatch($notification->id)
                ->onConnection('rabbitmq')
                ->onQueue($queueName);
        }

        Log::info('Notifications dispatched to sending queue', [
            'package_id'          => $package->id,
            'queue'               => $queueName,
            'notifications_count' => $package->notifications->count(),
        ]);
    }
}
