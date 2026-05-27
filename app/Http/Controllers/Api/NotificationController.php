<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationResource;
use App\UseCases\GetNotificationsByReceiverIdUseCase;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationController extends BaseController
{
    public function getByReceiver($receiver, GetNotificationsByReceiverIdUseCase $useCase): ResourceCollection
    {
        $notifications = $useCase->run($receiver);
        return NotificationResource::collection($notifications);
    }
}