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
 * @property string $last_error_message
 * @property NotificationStatus $status
 * @property int $attempt_count
 * @property int $status_check_count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $last_status_checked_at
 * @property Carbon|null $next_status_check_at
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
        'last_error_message',
        'next_status_check_at',
        'status_check_count',
        'last_status_checked_at'
    ];

    protected function casts(): array
    {
        return [
            'status' => NotificationStatus::class,
            'next_status_check_at' => 'datetime',
            'last_status_checked_at' => 'datetime',
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