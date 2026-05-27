<?php

declare(strict_types=1);

namespace App\UseCases;

use App\DTO\NotificationPackageData;
use App\Jobs\ProcessNotificationPackageJob;
use App\Models\NotificationPackage;
use App\Repositories\NotificationPackageRepository;
use App\Repositories\NotificationRepository;
use Illuminate\Support\Facades\Log;

class CreateNotificationPackageUseCase
{

    public function __construct(
        protected NotificationRepository $notificationRepository,
        protected NotificationPackageRepository $notificationPackageRepository
    ) {
    }

    public function run(NotificationPackageData $dto): NotificationPackage
    {
        $notificationPackage = $this->notificationPackageRepository->create($dto);
        $this->notificationRepository->batchCreate($notificationPackage->getId(), $dto->receivers);

        ProcessNotificationPackageJob::dispatch($notificationPackage->id)
            ->onConnection('rabbitmq')
            ->onQueue(ProcessNotificationPackageJob::QUEUE_NAME);

        return $notificationPackage;
    }
}