<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        //
    ];

    protected function scheduleTimezone()
    {
        return 'America/Guayaquil';
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('envios:programados')->everyMinute();
        $schedule->command('desactivar:interconexion')->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
