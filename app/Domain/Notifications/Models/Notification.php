<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Models;

use App\Domain\Notifications\Enums\NotificationStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $notification_package_id
 * @property string $receiver
 * @property NotificationStatus $status
 * @property int $attempt_count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @relations
 * @property-read NotificationPackage $package
 *
 * @method static Builder<static>|Notification newModelQuery()
 * @method static Builder<static>|Notification newQuery()
 * @method static Builder<static>|Notification query()
 * @method static Builder<static>|Notification whereAttemptCount($value)
 * @method static Builder<static>|Notification whereCreatedAt($value)
 * @method static Builder<static>|Notification whereId($value)
 * @method static Builder<static>|Notification whereNotificationPackageId($value)
 * @method static Builder<static>|Notification whereReceiver($value)
 * @method static Builder<static>|Notification whereStatus($value)
 * @method static Builder<static>|Notification whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Notification extends Model
{

    protected $table = 'notifications';

    public const string TYPE_NAME = 'notifications';
    protected $fillable = [
        'notification_package_id',
        'receiver',
        'status',
        'attempt_count',
        'last_error_message'
    ];

    protected function casts(): array
    {
        return [
            'status' => NotificationStatus::class,
        ];
    }


    public function package(): BelongsTo
    {
        return $this->belongsTo(NotificationPackage::class, 'notification_package_id');
    }

    public function getStatus(): NotificationStatus
    {
        return $this->status;
    }

    public function getReceiver(): string
    {
        return $this->receiver;
    }
}