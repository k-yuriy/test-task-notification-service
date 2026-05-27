<?php

namespace App\Console\Commands;

use App\Domain\Notifications\Models\Notification;
use App\Domain\Notifications\Services\SmsNotificationSender;
use App\DTO\UserData;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SmsNotificationSender $sender)
    {
        $notification = new Notification();
        $notification->receiver = 'qweqweqwe+79221974679';
        $sender->send($notification);
    }

}
