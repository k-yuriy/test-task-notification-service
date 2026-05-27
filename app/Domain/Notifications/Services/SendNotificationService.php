<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Services;

use App\Domain\Notifications\Exceptions\GatewayProviderException;
use App\Domain\Notifications\Exceptions\IncorrectNotificationStatusException;
use App\Domain\Notifications\Repositories\NotificationRepository;
use Illuminate\Support\Facades\Log;
use Throwable;

final readonly class SendNotificationService
{
    public function __construct(
        private NotificationSenderResolver $senderResolver,
        private NotificationRepository $notificationRepository,
    ) {
    }

    public function send(int $notificationId): void
    {
        try {
            $notification = $this->notificationRepository->getById($notificationId);

            if (!$notification->getStatus()->isReadyForSend()) {
                throw new IncorrectNotificationStatusException(
                    'Incorrect notification status: ' . $notification->getStatus()->value
                );
            }

            $this->notificationRepository->updateAttemptCount($notification);
            $sender = $this->senderResolver->resolve($notification->package->getChannel());
            $result = $sender->send($notification);

            if ($result->isSuccess()) {
                $this->notificationRepository->changeStatusToSent($notification);
            } else {
                $this->notificationRepository->changeStatusToError($notification, $result->getErrorMessage());
                throw new GatewayProviderException($result->getErrorMessage());
            }

        } catch (Throwable $exception) {
            Log::info('something went wrong in SendNotificationService', [
                'notification_id' => $notificationId,
                'error_message'   => $exception->getMessage()
            ]);
            throw $exception;
        }
    }
}