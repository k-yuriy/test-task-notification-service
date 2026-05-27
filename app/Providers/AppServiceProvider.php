<?php

namespace App\Providers;

use App\Domain\Notifications\Gateways\SMSGateway\Mock\SMSGatewayMock;
use App\Domain\Notifications\Gateways\SMSGateway\SMSGatewayInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [
            SMSGatewayInterface::class => SMSGatewayMock::class,
            // SMSGatewayInterface::class => SMSGateway::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
