<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

class SmsReceiverData extends Data
{

    //TODO подумать что делать с регвыром на номер телефона
    public function __construct(
        #[Required]
        #[StringType]
        #[Regex('/^\+[1-9]\d{7,14}$/')]
        public string $receiver,
    ) {

    }
}