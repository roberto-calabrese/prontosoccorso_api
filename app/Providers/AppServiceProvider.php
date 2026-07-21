<?php

namespace App\Providers;

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
     *
     * Le notifiche di scraping fallito sono gestite dal trait
     * App\Jobs\Concerns\AlertsOnScrapeFailure direttamente nei job (funziona sia
     * in coda/redis che in sincrono), quindi qui non serve alcun hook.
     */
    public function boot(): void
    {
        //
    }
}
