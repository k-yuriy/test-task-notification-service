<?php

namespace App\Domain\Notifications\Models;

use App\Domain\Notifications\Enums\NotificationChannel;
use App\Domain\Notifications\Enums\NotificationPriority;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property NotificationChannel $channel
 * @property NotificationPriority $priority
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @ralations
 * @property-read Notification[]|Collection $notifications
 *
 * @method static Builder<static>|NotificationPackage newModelQuery()
 * @method static Builder<static>|NotificationPackage newQuery()
 * @method static Builder<static>|NotificationPackage query()
 * @method static Builder<static>|NotificationPackage whereChannel($value)
 * @method static Builder<static>|NotificationPackage whereCreatedAt($value)
 * @method static Builder<static>|NotificationPackage whereId($value)
 * @method static Builder<static>|NotificationPackage wherePriority($value)
 * @method static Builder<static>|NotificationPackage whereText($value)
 * @method static Builder<static>|NotificationPackage whereUpdatedAt($value)
 * @mixin Eloquent
 */
class NotificationPackage extends Model
{

    public const string TYPE_NAME = 'notification-packages';

    protected $table = 'notification_packages';

    protected $fillable = [
        'channel',
        'priority',
        'text'
    ];

    protected function casts(): array
    {
        return [
            'channel'  => NotificationChannel::class,
            'priority' => NotificationPriority::class,
        ];
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getChannel(): NotificationChannel
    {
        return $this->channel;
    }

    public function getPriority(): NotificationPriority
    {
        return $this->priority;
    }
}
