<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class PingResource extends BaseJsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ping' => 'pong'
        ];
    }
}