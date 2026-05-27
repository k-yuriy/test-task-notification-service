<?php

namespace App\Http\Resources;

use App\Domain\Notifications\Models\NotificationPackage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin NotificationPackage
 */
class NotificationPackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'type'       => NotificationPackage::TYPE_NAME,
            'attributes' => [
                'channel'  => $this->channel,
                'priority' => $this->priority,
                'text'     => $this->text,
            ]
        ];
    }
}
