<?php

namespace Database\Seeders;

use App\Models\Aspirasi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AspirasiArsipSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID user pertama (atau random jika ingin bervariasi)
        $userId = User::pluck('id')->first();

        if (!$userId) {
            $this->command->error('Tidak ada user ditemukan. Harap seed dulu tabel users.');
            return;
        }

        $bulanList = ['2025-06', '2025-05', '2025-04'];

        foreach ($bulanList as $bulan) {
            for ($i = 1; $i <= 3; $i++) {
                $tanggalDibuat = Carbon::createFromFormat('Y-m-d', "$bulan-" . rand(1, 9))->startOfDay();
                $tanggalHapus = Carbon::createFromFormat('Y-m-d', "$bulan-15")->subDays(rand(0, 5));

                $aspirasi = Aspirasi::create([
                    'judul'      => "Aspirasi Arsip Bulan $bulan ke-$i",
                    'isi'        => "Ini adalah isi dari aspirasi ke-$i untuk bulan $bulan yang telah dihapus.",
                    'alamat'     => 'Jalan Dummy No. ' . rand(10, 99),
                    'status'     => 'menunggu',
                    'user_id'    => $userId,
                    'lampiran'   => null,
                    'created_at' => $tanggalDibuat,
                    'updated_at' => $tanggalDibuat,
                ]);

                // Soft delete dengan timestamp penghapusan yang ditentukan
                $aspirasi->deleted_at = $tanggalHapus;
                $aspirasi->save();
            }
        }

        $this->command->info('Seeder AspirasiArsipSeeder selesai dijalankan.');
    }
}
