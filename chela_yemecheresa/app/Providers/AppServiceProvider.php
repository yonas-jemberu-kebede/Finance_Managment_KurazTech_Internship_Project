<?php

namespace App\Providers;
use App\Models\currency_manager;
use App\Observers\CurrencyObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        currency_manager::observe(CurrencyObserver::class);
    }
}
