<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Domain\Notifications\UseCases\CheckNotificationStatusesUseCase;
use Illuminate\Console\Command;

class CheckDeliveryStatusCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'notifications:dispatch-status-checks';

    /**
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CheckNotificationStatusesUseCase $useCase)
    {
        $useCase->run();
    }


}