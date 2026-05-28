<?php

namespace App\Console\Commands;

use App\Domain\Notifications\Enums\NotificationStatus;
use App\Domain\Notifications\Models\Notification;
use App\Domain\Notifications\Services\CheckNotificationStatusService;
use App\DTO\UserData;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CheckNotificationStatusService $service)
    {

    }

}
