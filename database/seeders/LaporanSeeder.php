<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aspirasi;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    public function run()
    {
        // Hapus data laporan lama (optional)
        DB::table('laporan')->truncate();

        // Insert dari tabel Aspirasi
        $aspirasis = Aspirasi::all();
        foreach ($aspirasis as $aspirasi) {
            DB::table('laporan')->insert([
                'nama' => $aspirasi->nama ?? 'Tidak Diketahui',
                'email' => $aspirasi->email ?? null,
                'jenis' => 'aspirasi',
                'judul' => $aspirasi->judul ?? 'Tanpa Judul',
                'tanggal_laporan' => $aspirasi->created_at ?? Carbon::now(),
                'status' => $aspirasi->status ?? 'diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert dari tabel Pendaftaran Magang
        $pendaftars = PendaftaranMagang::all();
        foreach ($pendaftars as $pendaftar) {
            DB::table('laporan')->insert([
                'nama' => $pendaftar->nama ?? 'Tidak Diketahui',
                'email' => $pendaftar->email ?? null,
                'jenis' => 'magang',
                'judul' => $pendaftar->lowongan->judul ?? 'Lowongan Tidak Diketahui',
                'tanggal_laporan' => $pendaftar->created_at ?? Carbon::now(),
                'status' => $pendaftar->status ?? 'diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
