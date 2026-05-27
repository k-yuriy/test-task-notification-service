<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Models\Notification;
use App\Repositories\NotificationRepository;
use Illuminate\Database\Eloquent\Collection;

class GetNotificationsByReceiverIdUseCase
{
    public function __construct(
        protected NotificationRepository $notificationRepository,
    ) {
    }

    /**
     * @param string $receiver
     * @return Collection<int, Notification>
     */
    public function run(string $receiver): Collection
    {
        return $this->notificationRepository->findAllByReceiver($receiver);
    }
}