<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WalletService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(
            \App\Services\WalletService::class,
            function () {
                return new \App\Services\WalletService();
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
