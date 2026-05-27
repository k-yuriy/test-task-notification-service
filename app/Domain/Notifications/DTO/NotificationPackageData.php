<?php

declare(strict_types=1);

namespace App\Domain\Notifications\DTO;

use App\Domain\Notifications\Enums\NotificationChannel;
use App\Domain\Notifications\Enums\NotificationPriority;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class NotificationPackageData extends Data
{
    // TODO text min, max Validation
    public function __construct(
        #[Required]
        public NotificationChannel $channel,
        #[Required]
        public NotificationPriority $priority,
        #[Required,Min(5)]
        public string $text,
        /** @var array<int, ReceiverData> */
        #[DataCollectionOf(ReceiverData::class)]
        public array $receivers,
    ) {}
}