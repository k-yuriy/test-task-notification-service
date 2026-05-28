<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Gateways;

interface SendNotificationGatewayResultInterface
{

    public function isSuccess(): bool;

    public function getErrorMessage(): ?string;

}