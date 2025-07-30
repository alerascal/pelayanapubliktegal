<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PendaftaranMagang;
use Carbon\Carbon;

class UpdateMagangStatus extends Command
{
    protected $signature = 'status:cek-hangus';
    protected $description = 'Ubah status magang menjadi hangus jika lewat batas kedatangan';

    public function handle()
    {
        $pendaftarans = PendaftaranMagang::where('status', 'diterima')->get();

        foreach ($pendaftarans as $pendaftaran) {
            $startDate = Carbon::parse($pendaftaran->updated_at)->addDay();
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
                $pendaftaran->status = 'hangus';
                $pendaftaran->save();

                $this->info("Status pendaftar ID {$pendaftaran->id} diubah menjadi HANGUS.");
            }
        }

        $this->info("Pemeriksaan selesai.");
    }
}