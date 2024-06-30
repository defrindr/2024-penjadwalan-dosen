<?php

namespace App\Console\Commands;

use App\Helpers\WaSender;
use App\Models\Kegiatan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MyScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jadwal:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("Cron job Berhasil di jalankan " . date('Y-m-d H:i:s'));
        $startTime = date("Y-m-d", strtotime("-7 days"));
        // Fetch All Schedule -7 days
        $schedules = Kegiatan::where('tanggal', '>=', $startTime)->where('reminder', 0)->get();
        foreach ($schedules as $schedule) {
            try {
                WaSender::send($schedule->dosen->telp, 'Reminder: Terdapat kegiatan #' . $schedule->tugas . ", yang harus anda kerjakan");
                $schedule->update(['reminder' => 1]);
            } catch (\Throwable $th) {
                echo $th;
            }
        }
    }
}
