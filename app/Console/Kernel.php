<?php

namespace App\Console;

use App\Helpers\WaSender;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;

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
        $schedule->call(function () {
            $now = now()->toDateString();
            Kegiatan::where('tanggal', '<', $now)
                ->update(['status_kehadiran' => 'Hadir']);
        })->daily(); // Pengecekan dilakukan setiap hari

        $schedule->call(function () {
            $startTime = date("Y-m-d", strtotime("-7 days"));
            // Fetch All Schedule -7 days
            $schedules = Kegiatan::where('tanggal', '>=', $startTime)->where('remider', 0)->get();
            foreach ($schedules as $schedule) {
                WaSender::send($schedule->dosen->telp, 'Reminder: Terdapat kegiatan #' . $schedule->tugas . ", yang harus anda kerjakan");
                $schedule->update(['reminder' => 1]);
            }
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
