<?php

namespace App\Console;

use Eyika\Atom\Framework\Foundation\ConsoleKernel;
use Eyika\Atom\Framwork\Foundation\Console\Command;

class Kernel extends ConsoleKernel
{
    // /**
    //  * The Artisan commands provided by your application.
    //  *
    //  * @var array
    //  */
    // protected $commands = [
    //     Commands\BasicCommand::class,
    //     // SendAppointmentReminderEmail::class,
    // ];

    // /**
    //  * Define the application's command schedule.
    //  */
    // public function schedule(schedule $schedule): void
    // {
    //     $schedule->dispatch('appointment:reminder')->daily();
    //     // $schedule->dispatch(SendAppointmentReminderEmail::class)->hourly();
    // }

    // /**
    //  * Register the commands for the application.
    //  */
    // public function commands(): void
    // {
    //     // $this->load(__DIR__.'/Commands');

    //     require base_path('routes/console.php');
    // }

    protected $commands = [];

    public function register(string $name, Command $command)
    {
        $this->commands[$name] = $command;
    }

    public function run(string $name, array $arguments = [])
    {
        if (isset($this->commands[$name])) {
            $this->commands[$name]->handle($arguments);
        } else {
            echo "Error: Command '$name' not found." . PHP_EOL;
        }
    }
}
