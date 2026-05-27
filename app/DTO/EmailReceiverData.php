<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

class EmailReceiverData extends Data
{
    public function __construct(
        #[Required]
        #[StringType]
        #[Email]
        public string $receiver,
    ) {

    }
}