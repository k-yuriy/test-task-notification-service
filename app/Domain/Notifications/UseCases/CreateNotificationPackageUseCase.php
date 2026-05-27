<?php

declare(strict_types=1);

namespace App\Domain\Notifications\UseCases;

use App\Domain\Notifications\DTO\NotificationPackageData;
use App\Domain\Notifications\Jobs\ProcessNotificationPackageJob;
use App\Domain\Notifications\Models\NotificationPackage;
use App\Domain\Notifications\Repositories\NotificationPackageRepository;
use App\Domain\Notifications\Repositories\NotificationRepository;

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