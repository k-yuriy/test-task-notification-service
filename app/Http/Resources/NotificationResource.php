<?php

namespace App\Http\Resources;

use App\Domain\Notifications\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Notification
 */
class NotificationResource extends JsonResource
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
            'type'       => Notification::TYPE_NAME,
            'attributes' => [
                'receiver' => $this->receiver,
                'status'   => $this->status,
            ],
            'relationships' => [
                'package' => new NotificationPackageResource($this->package)
            ]
        ];
    }
}
