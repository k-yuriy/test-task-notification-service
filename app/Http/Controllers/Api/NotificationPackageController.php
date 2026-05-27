<?php

namespace App\Http\Controllers\Api;

use App\DTO\NotificationPackageData;
use App\DTO\ReceiverData;
use App\Enums\NotificationChannel;
use App\Enums\NotificationPriority;
use App\Http\Requests\CreateNotificationPackageRequest;
use App\Http\Resources\NotificationPackageResource;
use App\UseCases\CreateNotificationPackageUseCase;

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
