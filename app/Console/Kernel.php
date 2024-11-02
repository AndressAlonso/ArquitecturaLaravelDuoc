<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('ropa:baja')->daily(); // Esto se ejecuta a medianoche
    }

    protected function commands()
    {
        // Aquí se registran los comandos de Artisan
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
