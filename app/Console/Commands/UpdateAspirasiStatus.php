<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aspirasi;
use Carbon\Carbon;

class UpdateAspirasiStatus extends Command
{
    protected $signature = 'status:cek-hangus-aspirasi';
    protected $description = 'Ubah status aspirasi menjadi hangus jika lewat batas 7 hari kerja';

    public function handle()
    {
        $aspirasis = Aspirasi::where('status', 'diterima')->get();

        foreach ($aspirasis as $aspirasi) {
            $startDate = Carbon::parse($aspirasi->updated_at)->addDay();
            while ($startDate->isWeekend()) {
                $startDate->addDay();
            }

            $endDate = $startDate->copy();
            $daysAdded = 1;

            while ($daysAdded < 7) {
                $endDate->addDay();
                if (!$endDate->isWeekend()) {
                    $daysAdded++;
                }
            }

            if (Carbon::now()->greaterThan($endDate)) {
                $aspirasi->status = 'hangus';
                $aspirasi->save();

                $this->info("Status aspirasi ID {$aspirasi->id} diubah menjadi HANGUS.");
            }
        }

        $this->info("Pemeriksaan status aspirasi selesai.");
    }
}
