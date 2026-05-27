<?php

declare(strict_types=1);

namespace App\Domain\Notifications\UseCases;

use App\Domain\Notifications\Models\Notification;
use App\Domain\Notifications\Repositories\NotificationRepository;
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