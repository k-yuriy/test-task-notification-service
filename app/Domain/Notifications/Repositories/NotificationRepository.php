<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Repositories;

use App\Domain\Notifications\DTO\ReceiverData;
use App\Domain\Notifications\Enums\NotificationStatus;
use App\Domain\Notifications\Models\Notification;
use Illuminate\Database\Eloquent\Collection;

class NotificationRepository
{
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
            'status'               => NotificationStatus::Sent,
            'next_status_check_at' => now()->addMinute()
        ]);
    }

    public function changeStatusToError(Notification $notification, $errorMessage): void
    {
        $notification->update([
            'status'             => NotificationStatus::Error,
            'last_error_message' => $errorMessage,
        ]);
    }

    public function changeStatusToDelivered(Notification $notification): void
    {
        $notification->update([
            'status' => NotificationStatus::Delivered->value,
        ]);
    }

    public function setNextStatusCheck(Notification $notification): void
    {
        $notification->update([
            'next_status_check_at' => now()->addMinute()
        ]);
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotificationsForCheckStatuses(): Collection
    {
        return Notification::query()
            ->where('status', NotificationStatus::Sent)
            ->whereNotNull('next_status_check_at')
            ->where('next_status_check_at', '<=', now())
            ->orderBy('id')
            ->limit(500)
            ->get();
    }

    public function prepareToCheckStatus(Notification $notification): void
    {
        $notification->update([
            'next_status_check_at' => null,
            'status_check_count' => $notification->status_check_count + 1
        ]);
    }
}