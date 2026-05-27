<?php

namespace App\Http\Controllers\Api;

use App\Domain\Notifications\DTO\NotificationPackageData;
use App\Domain\Notifications\DTO\ReceiverData;
use App\Domain\Notifications\Enums\NotificationChannel;
use App\Domain\Notifications\Enums\NotificationPriority;
use App\Domain\Notifications\UseCases\CreateNotificationPackageUseCase;
use App\Http\Requests\CreateNotificationPackageRequest;
use App\Http\Resources\NotificationPackageResource;

class NotificationPackageController extends BaseController
{
    public function post(
        CreateNotificationPackageRequest $request,
        CreateNotificationPackageUseCase $useCase
    ): NotificationPackageResource {
        $dto = new NotificationPackageData(
            channel: NotificationChannel::from($request->input('data.attributes.channel')),
            priority: NotificationPriority::from($request->input('data.attributes.priority')),
            text: $request->input('data.attributes.text'),
            receivers: ReceiverData::collect($request->input('data.relationships.notifications.data'))
        );
        $notificationPackage = $useCase->run($dto);
        return new NotificationPackageResource($notificationPackage);
    }
}
