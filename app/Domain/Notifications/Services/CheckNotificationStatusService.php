<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Services;

use App\Domain\Notifications\Exceptions\IncorrectNotificationStatusException;
use App\Domain\Notifications\Repositories\NotificationRepository;
use Illuminate\Support\Facades\Log;

readonly class CheckNotificationStatusService
{
    public function __construct(
        private NotificationSenderResolver $senderResolver,
        private NotificationRepository $notificationRepository,
    ) {
    }

    public function checkNotification(int $notificationId): void
    {
        try {
            $notification = $this->notificationRepository->getById($notificationId);
            if (!$notification->getStatus()->isSent()) {
                throw new IncorrectNotificationStatusException(
                    'Incorrect notification status: ' . $notification->getStatus()->value
                );
            }

            $checker = $this->senderResolver->resolve($notification->package->getChannel());
            $result = $checker->checkDeliveryStatus($notification);

            if ($result->getDeliveryStatus()->isDelivered()) {
                $this->notificationRepository->changeStatusToDelivered($notification);
            } else {
                $this->notificationRepository->setNextStatusCheck($notification);
            }
        } catch (\Throwable $exception) {
            Log::info('something went wrong in CheckDeliveryStatusService', [
                'notification_id' => $notificationId,
                'error_message'   => $exception->getMessage()
            ]);
        }
    }
}