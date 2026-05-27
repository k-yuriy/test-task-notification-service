<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\NotificationPackageData;
use App\Models\NotificationPackage;

class NotificationPackageRepository
{
    public function create(NotificationPackageData $dto): NotificationPackage
    {
        $notificationPackage = new NotificationPackage();
        $notificationPackage->fill([
            'channel'  => $dto->channel,
            'text'     => $dto->text,
            'priority' => $dto->priority,
        ]);
        $notificationPackage->save();
        return $notificationPackage;
    }

    public function getById(int $id): NotificationPackage
    {
        return NotificationPackage::query()->with('notifications')->findOrFail($id);
    }
}