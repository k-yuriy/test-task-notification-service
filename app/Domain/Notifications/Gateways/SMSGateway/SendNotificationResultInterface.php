<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways\SMSGateway;

interface SendNotificationResultInterface
{

    public function isSuccess(): bool;

    public function getErrorMessage(): ?string;

    public function getStatus();

}