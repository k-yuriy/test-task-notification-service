<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Repositories;

use App\Domain\Notifications\DTO\ReceiverData;
use App\Domain\Notifications\Enums\NotificationStatus;
use App\Domain\Notifications\Models\Notification;
use Illuminate\Database\Eloquent\Collection;

class NotificationRepository
{
    /**
     * @param ReceiverData $receivers
     */
    public function create(int $packageId, array $receivers)
    {
        // TODO
    }

    public function getById(int $id): Notification
    {
        return Notification::query()->with('package')->findOrFail($id);
    }

    /**
     * @param int $packageId
     * @param array<int, ReceiverData> $receivers
     * @return void
     */
    public function batchCreate(int $packageId, array $receivers): void
    {
        $now = now();
        $notifications = collect($receivers)
            ->map(fn(ReceiverData $receiverData) => [
                'notification_package_id' => $packageId,
                'receiver'                => $receiverData->receiver,
                'status'                  => NotificationStatus::Queued->value,
                'attempt_count'           => 0,
                'created_at'              => $now,
                'updated_at'              => $now,
            ])
            ->all();
        Notification::query()->insert($notifications);
    }

    /**
     * @param string $receiver
     * @return Collection<int, Notification>
     */
    public function findAllByReceiver(string $receiver): Collection
    {
        return Notification::query()
            ->where(['receiver' => $receiver])
            ->with('package')
            ->get();
    }

    public function updateAttemptCount(Notification $notification): void
    {
        $notification->attempt_count++;
        $notification->save();
    }

    public function changeStatusToSent(Notification $notification): void
    {
        $notification->update([
            'status'        => NotificationStatus::Sent->value,
        ]);
    }

    public function changeStatusToError(Notification $notification, $errorMessage): void
    {
        $notification->update([
            'status'             => NotificationStatus::Error->value,
            'last_error_message' => $errorMessage,
        ]);
    }
}