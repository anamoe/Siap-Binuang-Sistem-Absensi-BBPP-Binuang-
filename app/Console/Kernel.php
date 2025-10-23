<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Notifications\AnonymousNotifiable;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // app/Console/Kernel.php

        $schedule->call(function () {
            $aset = \App\Models\Aset::first();

            if ($aset) {
                $notifiable = (new AnonymousNotifiable)->route('mail', 'anam45188@gmail.com');

                $notifiable->notify(new \App\Notifications\MaintenanceDueNotification($aset));
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
