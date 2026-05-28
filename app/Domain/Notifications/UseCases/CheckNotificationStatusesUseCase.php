<?php

declare(strict_types=1);

namespace App\Domain\Notifications\UseCases;

use App\Domain\Notifications\Jobs\CheckNotificationStatusJob;
use App\Domain\Notifications\Repositories\NotificationRepository;

class CheckNotificationStatusesUseCase
{
    public function __construct(protected NotificationRepository $notificationRepository)
    {

    }
    public function run(): void
    {
        $notifications = $this->notificationRepository->getNotificationsForCheckStatuses();

        foreach ($notifications as $notification) {
            CheckNotificationStatusJob::dispatch($notification->id)
                ->onConnection('rabbitmq')
                ->onQueue(CheckNotificationStatusJob::QUEUE_NAME);

            $this->notificationRepository->prepareToCheckStatus($notification);
        }
    }
}