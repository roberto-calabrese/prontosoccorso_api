<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Controllo completo delle sorgenti di scraping due volte al giorno.
        // withoutOverlapping: se un giro fosse ancora in corso (sorgenti lente
        // o irraggiungibili) il successivo non parte sovrapposto.
        $schedule->command('scrape:check')
            ->twiceDailyAt(7, 19, 30)
            ->withoutOverlapping()
            ->runInBackground();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
