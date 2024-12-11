<?php

namespace App\Console;

use App\Mail\SurpriseNotification;
use App\Models\Surprise;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $surprises = Surprise::where('send_at', '<=', now())->get();
            foreach ($surprises as $surprise) {
                Mail::to($surprise->recipient_email)->send(new SurpriseNotification($surprise));
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
