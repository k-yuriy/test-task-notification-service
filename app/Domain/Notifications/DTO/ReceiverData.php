<?php

declare(strict_types=1);

namespace App\Domain\Notifications\DTO;

use Spatie\LaravelData\Data;

class ReceiverData extends Data
{
    public function __construct(
        public string $receiver
    ) {}
}