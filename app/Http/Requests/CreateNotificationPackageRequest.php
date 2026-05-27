<?php

declare(strict_types=1);

namespace App\Http\Requests;


use App\Enums\NotificationChannel;
use App\Enums\NotificationPriority;
use App\Models\Notification;
use App\Models\NotificationPackage;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Validator;

class CreateNotificationPackageRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'data.type'                                        => [
                'required',
                'string',
                'in:' . NotificationPackage::TYPE_NAME
            ],
            'data.attributes'                                  => ['required', 'array'],
            'data.attributes.channel'                          => ['required', new Enum(NotificationChannel::class)],
            'data.attributes.priority'                         => ['required', new Enum(NotificationPriority::class)],
            'data.attributes.text'                             => ['required', 'string'],
            'data.relationships.notifications.data'            => ['required', 'array'],
            'data.relationships.notifications.data.*.type'     => [
                'required',
                'string',
                'in:' . Notification::TYPE_NAME
            ],
            'data.relationships.notifications.data.*.receiver' => ['required', 'string'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $channel = $this->input('data.attributes.channel');
            $notifications = $this->input('data.relationships.notifications.data', []);
            foreach ($notifications as $index => $notification) {
                $receiver = $notification['receiver'] ?? null;
                if ($channel === NotificationChannel::Email && !filter_var($receiver, FILTER_VALIDATE_EMAIL)) {
                    $validator->errors()->add(
                        "data.relationships.notifications.data.$index.receiver",
                        'The receiver must be a valid email address when channel is email.'
                    );
                }

                if ($channel === NotificationChannel::Sms && !$this->isValidPhone($receiver)) {
                    $validator->errors()->add(
                        "data.relationships.notifications.data.$index.receiver",
                        'The receiver must be a valid phone number when channel is sms.'
                    );
                }
            }
        });
    }

    private function isValidPhone(?string $value): bool
    {
        if ($value === null) {
            return false;
        }
        return preg_match('/^\+[1-9]\d{7,14}$/', $value) === 1;
    }
}