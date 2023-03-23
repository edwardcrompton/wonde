<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Wonde\Client;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function() {
            return new Client(config('services.client.auth_key'));
        });
    }

}
