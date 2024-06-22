<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Chapa\Chapa;

class ChapaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Chapa::class, function ($app) {
            return new Chapa(env('CHAPA_API_KEY'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
