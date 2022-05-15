<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Presence;
use App\Models\User;

use Carbon\Carbon;




class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
 
        // command('db:seed --class=AbsenceSeeder')->daily();
        
        $schedule->call(function () {
           

            $users = User::all();
            foreach($users as $user)
            {
                $presence = new Presence();
                $presence->date = Carbon::now()->format('Y-m-d');
                $presence->start_time = "0:0:0";
                $presence->end_time = "0:0:0";
                $presence->matricule = $user->matricule;
                $presence->save();
            }
           
        })
        ->everyMinute();
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
